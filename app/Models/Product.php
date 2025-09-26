<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'slug',
        'description',
        'price',
        'condition_type',
        'is_negotiable',
        'expiry_period',
        'expiry_period_type',
        'features',
        'is_sold',
        'is_featured',
        'status',
        //Automobiles Only
        'kilometer_run',
        'make_year',
        'color',
        //Automobiles & Electronics & Computer-Equipments & Fashion-Wear & Mobile-Accessories
        'manufacturer',
        //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games
        'usedFor_period',
        'usedFor_period_type',
        'warranty_type',
        'warranty_period',
        'warranty_period_type',
        //Automobiles & Beauty-Health & Book-Stationary & Computer-Equipments & Electronics  & Fashion-Wear & Home-Appliances & Mobile-Accessories & Music-Instruments & Sport-Fitness & Toys-Games & Food-Drinks & Pet-PetCare
        'has_home_delivery',
        'delivery_area',
        'delivery_charge',
        //Fashion-Wear Only
        'quantity',
        //Fashion-Wear & Real State
        'size',
        //Real State Only
        'location',
        'created_by',
        'updated_by',
    ];
}
