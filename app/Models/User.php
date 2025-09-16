<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'email',
        'role_id',
        'password',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     *Filter by status.
     *
     */
    public function scopeStatusFilter($query, $filter)
    {
        if ($filter) {
            return $query->where('active', $filter == 'Active' ? 1 : 0);
        }

        return $query;
    }

    /**
     *Filter by deleted items.
     *
     */
    public function scopeDeletedItemFilter($query, $filter)
    {
        if ($filter) {
            if ($filter == "Only Deleted") {
                return $query->onlyTrashed();
            } else {
                return $query->withTrashed();
            }
            
        }

        return $query;
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function role()
    {
        return $this->belongsTo('Spatie\Permission\Models\Role');
    }

    /**
     *Filter by Role.
     *
     */
    public function scopeCityFilter($query, $filter)
    {
        if ($filter) {
            return $query->whereHas('profile', function ($q) use ($filter) {
                        $q->whereHas('city', function ($r) use ($filter) {
                            $r->where('name', $filter);
                        });
                    });
        }

        return $query;
    }

    /**
     *Filter by Role.
     *
     */
    public function scopeRoleFilter($query, $filter)
    {
        if ($filter) {
            return $query->whereHas('role', function ($q) use ($filter) {
                        $q->where('name', $filter);
                    });
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
                    ->OrWhere('email', 'like', '%' . $search . '%')
                    ->OrWhereHas('role', function ($r) use ($search) {
                        $r->where('display_name', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('profile', function ($r) use ($search) {
                        $r->where('phone1', 'like', '%' . $search . '%')
                          ->orWhere('phone2', 'like', '%' . $search . '%')
                          ->orWhere('address', 'like', '%' . $search . '%')
                          ->orWhereHas('city', function ($q) use ($search) {
                               $q->where('name', 'like', '%' . $search . '%');
                          })
                          ->orWhereHas('country', function ($q) use ($search) {
                               $q->where('name', 'like', '%' . $search . '%');
                          });
                    });
    }

    /**
     * Delete the relation of user
    */
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($user) {
            if ($user->isForceDeleting()) {
                $user->profile()->withTrashed()->forceDelete();
                $user->products()->withTrashed()->forceDelete();
            } else {
                $user->profile()->delete();
                $user->products()->delete();
                $user->notifications()->delete();
            }
        });

        static::restoring(function ($user) {
            $user->profile()->withTrashed()->restore();
            $user->products()->withTrashed()->restore();
        });
    }
}
