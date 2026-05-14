<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }
}
