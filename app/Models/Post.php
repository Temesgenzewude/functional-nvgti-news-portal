<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "desc",
        "short_desc",
        "image",
        "is_special",
        "is_breaking",
        "views",
        "category_id",
        "user_id"
    ];

    public function category()
    {
        return $this -> belongsTo("App\Models\Category");
    }

    public function user()
    {
        return $this -> belongsTo("App\Models\User");
    }

    public function tags()
    {
        return $this -> hasMany("App\Models\Tag");
    }
}
