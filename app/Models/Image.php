<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'post_id',
    ];

     /**
     * Bir resim bir post'a aittir.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
