<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;
use App\Models\TopUpProduct;

class ProfileModel extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'email',
        'game_uid',
        'sender_number',
        'transaction_id',
        'product_id',
        'top_up_product_id',
        'game_id',
        'payment_method',
        'price',
        'status',
        'discount',
        // Add other columns as needed
    ];

    /**
     * The user who made the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The game related to the order.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * The originally selected product.
     */
    public function product()
    {
        return $this->belongsTo(TopUpProduct::class, 'product_id');
    }

    /**
     * The final top-up product used (if different).
     */
    public function topUpProduct()
    {
        return $this->belongsTo(TopUpProduct::class, 'top_up_product_id');
    }

    /**
     * Accessor for final price after discount.
     */
    public function getFinalPriceAttribute()
    {
        return $this->price - ($this->discount ?? 0);
    }
}
