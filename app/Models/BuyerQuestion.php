<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'product_id',
        'question',
        'answer',
        'answer2',  //Admin Answer
        'asked_by',
        'is_read'
    ];

    public function askedBy()
    {
        return $this->belongsTo(User::class, 'asked_by');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     *Search By Given Criteria In Frontend
     *
     */
    public function scopeBuyerQuestionSearch($query, $search)
    {
        return $query->where('question', 'like', '%' . $search . '%')
                    ->OrWhereHas('product', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%')
                          ->OrWhereHas('category', function ($s) use ($search) {
                                $s->where('title', 'like', '%' . $search . '%');
                          })
                          ->OrWhereHas('subCategory', function ($s) use ($search) {
                                $s->where('title', 'like', '%' . $search . '%');
                          });
                    })
                    ->OrWhereHas('askedBy', function ($r) use ($search) {
                        $r->where('name', 'like', '%' . $search . '%');
                    });
    }

    /**
     *Search By Given Criteria In Frontend
     *
     */
    public function scopeYourQuestionSearch($query, $search)
    {
        return $query->where('question', 'like', '%' . $search . '%')
                    ->OrWhereHas('product', function ($r) use ($search) {
                        $r->where('title', 'like', '%' . $search . '%')
                          ->OrWhereHas('category', function ($s) use ($search) {
                                $s->where('title', 'like', '%' . $search . '%');
                          })
                          ->OrWhereHas('subCategory', function ($s) use ($search) {
                                $s->where('title', 'like', '%' . $search . '%');
                          });
                    });
    }

    /**
     *Filter by category.
     *
     */
    public function scopeCategoryFilter($query, $filter)
    {
        if ($filter) {
            return $query->whereHas('product', function ($q) use ($filter) {
                        $q->whereHas('category', function ($s) use ($filter) {
                            $s->where('slug', $filter);
                        });
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
            return $query->whereHas('product', function ($q) use ($filter) {
                        $q->whereHas('subCategory', function ($s) use ($filter) {
                            $s->where('slug', $filter);
                        });
                    });
        }

        return $query;
    }
    

    public function getRouteKeyName()
    {
        return 'question_id';
    }
}
