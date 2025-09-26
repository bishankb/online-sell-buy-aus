<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'title', 'sub_category_for', 'slug', 'home_visibility', 'status', 'created_by', 'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     *Filter by category.
     *
     */
    public function scopeCategoryFilter($query, $filter)
    {
        if ($filter) {
            return $query->whereHas('category', function ($q) use ($filter) {
                        $q->where('slug', $filter);
                    });
        }

        return $query;
    }

    /**
     *Filter by title, category, createdBy and updatedBy.
     *
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
                    ->OrWhereHas('category', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('createdBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('updatedBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    });
    }

    /**
     * Delete the relation of category
    */
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($sub_category) {
            if ($sub_category->isForceDeleting()) {
                $sub_category->products()->withTrashed()->forceDelete();
            } else {
                $sub_category->products()->delete();
            }
        });

        static::restoring(function ($sub_category) {
            $sub_category->products()->withTrashed()->restore();
        });
    }
}
