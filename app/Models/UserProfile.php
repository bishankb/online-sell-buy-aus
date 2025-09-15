<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'user_id', 'phone1', 'phone2', 'address', 'city_id', 'country_id', 'user_image_id',
    ];

    protected $dates = ['created_at','updated_at', 'deleted_at'];

    public function image()
    {
        return $this->belongsTo(Media::class, 'user_image_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
