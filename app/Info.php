<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    public $timestamps = false;
    protected $table = 'info';

    protected $fillable = [
        'title', 'content'
    ];
}
