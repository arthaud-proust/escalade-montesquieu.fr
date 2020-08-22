<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $table = 'blog_posts';

    protected $fillable = [
        'title', 'blog', 'datetime', 'location', 'content', 'availables', 'unavailables', 'descenders', 'harness_need', 'shoes_need'
    ];
}
