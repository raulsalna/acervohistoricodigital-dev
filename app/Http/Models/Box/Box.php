<?php

namespace App\Http\Models\Box;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Box extends Model
{
  use SoftDeletes;

  protected $appends = ['hash'];

  protected $fillable = ['fileName', 'place', 'depositRoom', 'corridor', 'shelf', 'strep', 'box'];

  public function getHashAttribute()
  {
    return encrypt($this->id);
  }
    // Start Scopes
  public function scopeSearch($query, $search)
  {
      return $query->when(! empty ($search), function ($query) use ($search) {
          return $query->where(function($q) use ($search)
          {
              $q->where('fileName', 'like', '%' .$search . '%');
          });
      });
  }
  public function scopePlacebox($query, $placebox)
  {
    if($placebox) {
      return $query
        ->where('place', 'like', "%$placebox%");
    }
    return $query;
  }
  public function scopeNamebox($query, $namebox)
  {
    if($namebox) {
      return $query
        ->where('fileName', 'like', "%$namebox%");
    }
    return $query;
  }
  public function scopeDepositRoom($query, $depositRoom)
  {
    if($depositRoom) {
      return $query
        ->where('depositRoom', 'like', "%$depositRoom%");
    }
    return $query;
  }  public function scopeCorridor($query, $corridor)
  {
    if($corridor) {
      return $query
        ->where('corridor', 'like', "%$corridor%");
    }
    return $query;
  }
  public function scopeStartdate($query, $startDate)
  {
    if($startDate) {
      return $query->whereBetween('created_at', $startDate);
    }
    return $query;
  }
  protected $hidden =  ['created_at', 'updated_at', 'deleted_at'];
}
