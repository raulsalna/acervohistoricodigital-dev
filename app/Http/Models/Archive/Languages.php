<?php

namespace App\Http\Models\Archive;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Cats\CatIdioms;
class Languages extends Model
{
    protected $table='form_archives_languages';

    protected $with = ['catIdioms'];

    protected $fillable = ['form_archives_id', 'geo_cat_idioms_id'];
    
    function catIdioms()
	{
		return $this->belongsTo(CatIdioms::class, 'geo_cat_idioms_id', 'id');
	}
}
