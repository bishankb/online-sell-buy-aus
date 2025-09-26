<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category_for', 'slug', 'status', 'created_by', 'updated_by'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
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
        
        static::deleting(function($category) {
            if ($category->isForceDeleting()) {
                $category->subCategories()->withTrashed()->forceDelete();
                $category->products()->withTrashed()->forceDelete();
            } else {
                $category->subCategories()->delete();
                $category->products()->delete();
            }
        });

        static::restoring(function ($category) {
            $category->subCategories()->withTrashed()->restore();
            $category->products()->withTrashed()->restore();
        });
    }
}
