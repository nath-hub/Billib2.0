<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];



    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }



    /*
    |--------------------------------------------------------------------------
    | scope
    |--------------------------------------------------------------------------
    */


    public function scopeUser_id($query, $user_id)
    {

        return $query->where('user_id', $user_id);
    }


    public function scopeFilter(Builder $query, array $filterData)
    {

        $query->when($filterData['name_store'] ?? null, function ($query, $nameStore) {

            $query->where('name_store', 'like', '%' . $nameStore . '%');
        })->when($filterData['adresse'] ?? null, function ($query, $adresse) {

            $query->where('adresse', 'like', '%' .  $adresse . '%');
        })->whereHas('articles', function ($query) use ($filterData) {

            $query->when($filterData['articles.name_article'] ?? null, function ($query, $nameArticle) {
                $query->where('name_article', 'like', '%' . $nameArticle . '%');
            })->when($filterData['articles.categories'] ?? null, function ($query, $categories) {
                $query->where('categories', 'like', '%' . $categories . '%');
            })->when($filterData['articles.unity_price'] ?? null, function ($query, $unityPrice) {
                $query->where('unity_price', '=', $unityPrice);
            })->when($filterData['articles.total'] ?? null, function ($query, $total) {
                $query->where('total', '=', $total);
            });
        });
    }
}
