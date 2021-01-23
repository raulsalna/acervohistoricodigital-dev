<?php

namespace App\Http\Models\Cats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatBox extends Model
{
    protected $table='cat_box';

    protected $appends = ['hash'];

    protected $fillable = [
        'name',
    ];

    public function getHashAttribute()
    {
        return encrypt($this->id);
    }
}
