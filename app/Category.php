<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = true;


  	public function getURLAttribute()
  	{
  		return $this->attributes['url'] = route('category.show',[$this->slug]);
  	}	
}
