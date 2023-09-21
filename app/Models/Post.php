<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $with = ["user"];
    use HasFactory;
    public function comments()
    {
        $this->hasMany(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}