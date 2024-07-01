<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'image',
        'category_id',
        'user_id',
        'url'
        
    ];

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

     public function category()
    {
        return $this -> belongsTo("App\Models\Category");
    }
}
