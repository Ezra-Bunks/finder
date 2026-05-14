<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'institution_id',
        'category_id',
        'title',
        'description',
        'location_found',
        'contact_phone',
        'date_found',
        'photo_path',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function institution(){
        return $this->belongsTo(Institution::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query){
        return $query->where('status', 'active');
    }

    public function scopeArchived($query){
        return $query->where('status', 'reunited');
    }
}
