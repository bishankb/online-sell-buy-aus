<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'faq', 'answer', 'status', 'slug', 'created_by', 'updated_by'
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('faq', 'like', '%' . $search . '%')
                    ->OrWhereHas('createdBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('updatedBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    });
    }
}
