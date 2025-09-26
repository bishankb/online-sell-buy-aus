<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename', 'original_filename', 'extension', 'mime', 'type', 'file_size'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'media_product', 'media_id', 'product_id');
    }
}
