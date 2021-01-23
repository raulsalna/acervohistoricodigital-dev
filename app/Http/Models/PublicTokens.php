<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PublicTokens extends Model
{
    protected $fillable = ['tender_id','event_id','limitDate','isActive'];

  public function tender()
  {
    return $this->hasOne(Tender::class, 'id','tender_id');
  }

  public function event()
  {
    return $this->hasOne(Event::class, 'id','event_id');
  }
}
