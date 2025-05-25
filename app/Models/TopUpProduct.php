<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpProduct extends Model
{
   use HasFactory;

    protected $fillable = [
        
        'game_id',
        'product_name',
        'amount',
        'price',
        'delivery_time',
        'instructions',
    ];

    // Relation with Game model
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
    
}
