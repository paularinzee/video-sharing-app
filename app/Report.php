<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reported_videos';

    public $timestamps = true;

    public function video()
    {
    	return $this->hasOne('App\Video','id','video_id');
    }

    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

}
