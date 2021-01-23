<?php

namespace App\Http\Models\Archive;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Cats\CatProducer;
class Producer extends Model
{
    protected $table='form_archives_producers';

    protected $with = ['catProducer'];

    protected $fillable = ['form_archives_id', 'cat_producer_id'];

    function catProducer()
	{
		return $this->belongsTo(CatProducer::class, 'cat_producer_id', 'id');
	}
}
