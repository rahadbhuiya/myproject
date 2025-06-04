<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Fillable properties
    protected $fillable = [
        'name',
        'image',
        'description',
    ];

    // Relation with Game model (assuming each category has many games)
    public function games()
    {
        return $this->hasMany(Game::class);
    }



}
