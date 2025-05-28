<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
use HasFactory;

    // Fillable properties
    protected $fillable = [
        'name',
        'logo',
        'description',
        'category_id',
    ];

    // Relation with Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // public function products()
    // {
    //     return $this->hasMany(Product::class); // or TopUpProduct::class
    // }

    public function products()
    {
        return $this->hasMany(TopUpProduct::class);
        return $this->hasMany(Product::class);
    }
    

}
