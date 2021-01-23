<?php

namespace App\Http\Models\Archive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use SoftDeletes;

    protected $appends = ['hash'];

    protected $with = ['languages','producer','support'];

    protected $table='form_archives';

    protected $fillable = [ 'code',
                            'box_id',
                            'proceedings_id',
                            'placement',
                            'title',
                            'group_id',
                            'year',
                            'openingDate',
                            'closingDate',
                            'startVolume',
                            'endVolume',
                            'characters_id',
                            'documentaryTradition_id',
                            'description',
                            'appendNotes',
                            'notesArchivist'
                        ];

    public function getHashAttribute()
    {
        return encrypt($this->id);
    }

    public function scopeSearch($query, $search)
  {
      return $query->when(! empty ($search), function ($query) use ($search) {
          return $query->where(function($q) use ($search)
          {
              $q->where('title', 'like', '%' .$search . '%');
          });
      });
  }

  public function scopePlacement($query, $placement)
  {
    if($placement) {
      return $query
        ->where('place', 'like', "%$placement%");
    }
    return $query;
  }
  public function scopeTitle($query, $title)
  {
    if($title) {
      return $query
        ->where('title', 'like', "%$title%");
    }
    return $query;
  }
  public function scopeOpeningDate($query, $openingDate)
  {
    if($openingDate) {
      return $query->whereBetween('openingDate', $openingDate);
    }
    return $query;
  }
  
  function languages(){
    
    return $this->hasMany('App\Http\Models\Archive\Languages','form_archives_id','id')->orderBy('geo_cat_idioms_id','asc');
  }

  function producer(){
    
    return $this->hasMany('App\Http\Models\Archive\Producer','form_archives_id','id')->orderBy('cat_producer_id','asc');
  }

  function support(){
    
    return $this->hasMany('App\Http\Models\Archive\Support','form_archives_id','id')->orderBy('cat_support_id','asc');
  }

  


  protected $hidden =  ['created_at', 'updated_at', 'deleted_at'];

}
