<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'user_id',
    ];

     /**
     * Bir post, bir kullanıcıya aittir.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Bir post, bir veya birden fazla resme sahiptir.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
