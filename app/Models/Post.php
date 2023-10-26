<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'describe_short',
        'created_at',
        'image'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}