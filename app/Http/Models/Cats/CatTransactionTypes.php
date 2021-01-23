<?php

namespace App\Http\Models\Cats;

use Illuminate\Database\Eloquent\Model;

class CatTransactionTypes extends Model
{
    protected $appends = ['hash'];
    
    protected $table='cat_transaction_types';

    protected $fillable = [
        'name',
    ];

    public function getHashAttribute()
    {
        return encrypt($this->id);
    }
}
