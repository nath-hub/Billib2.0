<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
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

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
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

    public function scopeArticle($query, $user_id, $ticket_id){
        return $query->where('user_id', $user_id)->where('ticket_id', $ticket_id);
    }
}
