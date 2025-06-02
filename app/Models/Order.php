<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;
use App\Models\TopUpProduct;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',             // (nullable if guest)
        'email',               // Buyer’s email
        'game_uid',            // Game account identifier
        'sender_number',       // Phone or sender number for payment
        'transaction_id',      // Unique payment/transaction ID
        'product_id',          // Primary TopUpProduct ID
        'top_up_product_id',   // Optional alternate TopUpProduct ID
        'game_id',             // Related Game ID
        'payment_method',      // Payment method used
        'price',               // Amount paid
        'status',              // Order status: e.g., pending, completed, failed
        'discount',            // Discount percentage applied
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price'    => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    /**
     * An order optionally belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An order belongs to a game.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * An order belongs to a TopUpProduct via product_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(TopUpProduct::class, 'product_id');
    }

    /**
     * An order optionally belongs to a TopUpProduct via top_up_product_id.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topUpProduct()
    {
        return $this->belongsTo(TopUpProduct::class, 'top_up_product_id');
    }

    /**
     * Accessor: final price after applying discount.
     *
     * @return float
     */
    public function getFinalPriceAttribute(): float
    {
        if ($this->discount > 0) {
            $discountAmount = ($this->price * $this->discount) / 100;
            return $this->price - $discountAmount;
        }

        return $this->price;
    }

    /**
     * Accessor: formatted price with currency (BDT).
     *
     * @return string
     */
    public function getPriceFormattedAttribute(): string
    {
        return number_format($this->price, 2) . ' BDT';
    }

    /**
     * Accessor: formatted final price with currency (BDT).
     *
     * @return string
     */
    public function getFinalPriceFormattedAttribute(): string
    {
        return number_format($this->final_price, 2) . ' BDT';
    }

    /**
     * Accessor: discount as a percentage string.
     *
     * @return string
     */
    public function getDiscountFormattedAttribute(): string
    {
        return $this->discount > 0
            ? $this->discount . '%'
            : 'No Discount';
    }

    /**
     * Accessor: discount percentage or 'No Discount'.
     *
     * @return string
     */
    public function getDiscountPercentageAttribute(): string
    {
        return $this->discount > 0
            ? $this->discount . '%'
            : 'No Discount';
    }
}
