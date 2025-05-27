<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Mass assignable attributes (fillable)
    protected $fillable = [
        'user_id',             // User who placed the order (nullable if guest)
        'email',               // Email of the buyer
        'game_uid',            // User's game ID or account identifier
        'sender_number',       // Phone or sender number for payment
        'transaction_id',      // Unique transaction/payment ID
        'product_id',          // Related TopUpProduct ID
        'top_up_product_id',   // Optional: related TopUpProduct ID if different
        'game_id',             // Related Game ID
        'payment_method',      // Payment method used
        'price',               // Price paid
        'status',              // Order status e.g. pending, completed
    ];

    /**
     * Relationship: Order belongs to a User (optional).
     * Useful if you have registered users.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Order belongs to a Game.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relationship: Order belongs to a TopUpProduct through product_id.
     */
    public function product()
    {
        return $this->belongsTo(TopUpProduct::class, 'product_id');
    }

    /**
     * Relationship: Optional link to a TopUpProduct through top_up_product_id.
     * This can be used if you have a separate column for some reason.
     */
    public function topUpProduct()
    {
        return $this->belongsTo(TopUpProduct::class, 'top_up_product_id');
    }
}
