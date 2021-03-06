<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class Photo extends Model
{
    protected $table = 'photos';

	protected $fillable = [
		'slug',
		'gallery',
		'gallery_name',
		'background',
		'src',
		'name',
		'date',
		'text',
		'exposed',
	];

	public function scopeExposed($query) {
		return $query->where('exposed', 1);
	}
	public function getGalleryObjAttribute() {
		return gallery::firstWhere('slug', $this->gallery);
	}
}
