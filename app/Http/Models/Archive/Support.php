<?php

namespace App\Http\Models\Archive;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Cats\CatSupport;
class Support extends Model
{
    protected $table='form_archives_supports';

    protected $with = ['catSupport'];

    protected $fillable = ['form_archives_id', 'cat_support_id'];

    function catSupport()
	{
		return $this->belongsTo(CatSupport::class, 'cat_support_id', 'id');
    }
    
}
