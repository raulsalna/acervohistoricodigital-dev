<?php

namespace App\Http\Models\Cats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatPhysicalCharacteristics extends Model
{
    protected $table='cat_physiscal_characteristics';

    protected $appends = ['hash'];

    protected $fillable = [
        'name',
    ];

    public function getHashAttribute()
    {
        return encrypt($this->id);
    }
}
