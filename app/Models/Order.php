<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'user_id',
        'email',
        'game_uid',
        'sender_number',
        'transaction_id',
        'product_id',
        'top_up_product_id', // assuming this exists in your DB
        'game_id',
        'payment_method',
        'price',
        'status',
    ];

    /**
     * An order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order belongs to a game.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * An order belongs to a product (top up product).
     */
    public function product()
    {
        return $this->belongsTo(TopUpProduct::class, 'product_id');
    }

    /**
     * If you want to explicitly relate to top_up_product_id as well.
     */
    public function topUpProduct()
    {
        return $this->belongsTo(TopUpProduct::class, 'top_up_product_id');
    }
}
