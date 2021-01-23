<?php

namespace App\Http\Models\Cats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatFiles extends Model
{
    protected $appends = ['hash'];
    
    protected $table='cat_files';

    protected $fillable = [
        'name',
    ];

    public function getHashAttribute()
    {
        return encrypt($this->id);
    }
}
