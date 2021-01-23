<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $appends = ['hash'];

    protected $fillable = ['user_id', 'fileName'];

    public function getHashAttribute()
    {
        return encrypt( $this->id );
    }

}
