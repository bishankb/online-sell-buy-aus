<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name1', 'name2', 'phone1', 'phone2', 'address', 'fax', 'email', 'facebook', 'twitter', 'map_embedded_link',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
