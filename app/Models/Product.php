<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;

class Product extends BaseModel implements Viewable
{
    use InteractsWithViews;
    
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

    const ConditionType = [
        'Brand New',
        'Excellent',
        'Good/Fair',
        'Not Working'
    ];

    const ExpiryPeriod = [
        'One Month',
        'Two Months',
        'Four Months',
        'Six Months',
        'One Week',
        'Two Weeks'
    ];

    const TimePeriod = [
        'Year(s)',
        'Month(s)',
        'Week(s)',
        'Day(s)'
    ];

    const DeliveryArea = [
        'Within my Area',
        'Within my City',
        'Almost anywhere'
    ];

    const WarrantyTypes = [
        'Dealer/Shop',
        'Manufacturer/Importer',
        'No Warranty'
    ];

    protected $dates = ['expiry_period'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
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
     *Filter by category.
     *
     */
    public function scopeSubCategoryFilter($query, $filter)
    {
        if ($filter) {
            return $query->whereHas('subCategory', function ($q) use ($filter) {
                        $q->where('slug', $filter);
                    });
        }

        return $query;
    }

    /**
     *Filter by sold items.
     *
     */
    public function scopeSoldItemFilter($query, $filter)
    {
        if ($filter) {
            if ($filter == "Sold Items") {
                return $query->where('is_sold', 1);
            } else {
                return $query->where('is_sold', 0);
            }
            
        }

        return $query;
    }

    /**
     *Filter by featured items.
     *
     */
    public function scopeFeaturedItemFilter($query, $filter)
    {
        if ($filter) {
            if ($filter == "Featured Items") {
                return $query->where('is_featured', 1);
            } else {
                return $query->where('is_featured', 0);
            }
            
        }

        return $query;
    }

    /**
     *Filter by expired items.
     *
     */
    public function scopeExpiredItemFilter($query, $filter)
    {
        if ($filter) {
            if ($filter == "Expired Items") {
                return $query->where('expiry_period', '<', Carbon::now());
            } else {
                return $query->where('expiry_period', '>', Carbon::now());
            }
            
        }

        return $query;
    }

    /**
     *Sort By popular, recent, old, low-high, high-low.
     *
     */
    public function scopeSort($query, $filter)
    {
        if ($filter) {
            if ($filter == "popular") {
                return $query->where('status', 1)->where('is_sold', 0)->orderByViewsCount();
            } elseif($filter == "recent") {
                return $query->where('status', 1)->where('is_sold', 0)->latest();
            } elseif($filter == "old") {
                return $query->where('status', 1)->where('is_sold', 0)->orderBy('id', 'asc');
            } elseif($filter == "low-high") {
                return $query->where('status', 1)->where('is_sold', 0)->orderBy('price', 'asc');
            } elseif($filter == "high-low") {
                return $query->where('status', 1)->where('is_sold', 0)->orderBy('price', 'desc');
            }
        }

        return $query;
    }

     /**
     *Search By Given Criteria In Backend and Frontend Main Search
     *
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
                    ->OrWhere('manufacturer', 'like', '%' . $search . '%')
                    ->OrWhereHas('category', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('subCategory', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('createdBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%')
                          ->OrWhereHas('profile', function ($q) use ($search) {
                            $q->where('phone1', $search)
                              ->orWhere('phone2', $search)
                              ->orWhere('address', $search)
                              ->orWhereHas('city', function ($s) use ($search) {
                                    $s->where('name', $search);
                              })
                              ->orWhereHas('country', function ($s) use ($search) {
                                    $s->where('name', $search);
                              });
                          });
                    })
                    ->OrWhereHas('updatedBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    });
    }

    /**
     *Search By Given Criteria In Frontend
     *
     */
    public function scopeFrontendSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
                    ->OrWhere('manufacturer', 'like', '%' . $search . '%')
                    ->OrWhereHas('category', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%');
                    })
                    ->OrWhereHas('subCategory', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%');
                    });
    }

    public function images()
    {
        return $this->belongsToMany(Media::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Delete the relation of user
    */
    protected static function boot() {
        parent::boot();
        
        static::deleting(function($product) {
            $product->images()->delete();
        });

    }
}
