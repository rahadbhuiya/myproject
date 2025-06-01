<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileModel extends Model
{
    protected $table = 'profile_models';  // Explicitly define table name

    protected $fillable = [
        'user_id',
        'profile_name',
        'bio',
        // other fields...
    ];

    // Relation to User (optional, but useful)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
