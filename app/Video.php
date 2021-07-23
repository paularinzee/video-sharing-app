<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';

    public $timestamps = true;

    public function category()
    {
        return $this->hasOne('App\Category','id','category_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function likes()
    {
        return $this->hasMany('risul\LaravelLikeComment\Models\Like','item_id','id')->where('vote',1);
    }

    public function dislikes()
    {
        return $this->hasMany('risul\LaravelLikeComment\Models\Like','item_id','id')->where('vote',-1);
    }

    public function getThumbAttribute()
    {
        if(!empty($this->thumbnail)){ 
            return $this->attributes['thumb'] = $this->thumbnail;
        }
        else{
            return $this->attributes['thumb'] = 'http://via.placeholder.com/320x180/5DBCD2.png/fff?text='.urlencode($this->title);
        }
    }
    public function getCreatedAgoAttribute()
    {
        return $this->attributes['created_ago'] = $this->created_at->diffForHumans();
    }   
    
    public function getURLAttribute()
    {
        return $this->attributes['url'] = url('videos/'.$this->id.'/'.$this->slug);
    }       
}
