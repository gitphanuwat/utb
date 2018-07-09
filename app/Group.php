<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model  {

	protected $table = 'groups';

	public function area()
	{
		return $this->belongsTo('App\Area');
	}

	public function center()
	{
		return $this->belongsTo('App\Center');
	}

	public function university()
	{
		return $this->belongsTo('App\University');
	}


	public function user()
  {
    return $this->hasMany('App\User');
  }
}
