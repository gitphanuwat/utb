<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model  {

	protected $table = 'areas';

	public function center()
	{
		return $this->belongsTo('App\Center');
	}

	public function university()
	{
		return $this->belongsTo('App\University');
	}

	public function problem()
  {
    return $this->hasMany('App\Problem');
  }

	public function expert()
  {
    return $this->hasMany('App\Expert');
  }

	public function areafile()
  {
    return $this->hasMany('App\Areafile');
  }
}
