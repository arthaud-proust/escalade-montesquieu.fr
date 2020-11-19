<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    public $timestamps = false;
    protected $table = 'blog_list';

    protected $fillable = [
        'name', 'slug', 'description', 'is_regular'
    ];


    public static function boot()
    {
        parent::boot();

        static::updating(function ($instance) {
            // update cache content
            Cache::put('blog.'.$instance->slug,$instance);
        });

        static::deleting(function ($instance) {
            // delete post cache
            Cache::forget('blog.'.$instance->slug);
        });
    }
}
