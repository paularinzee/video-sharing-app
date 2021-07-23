<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
  

  	public function getURLAttribute()
  	{
  		return $this->attributes['url'] = route('page.show',[$this->slug]);
  	}
}
