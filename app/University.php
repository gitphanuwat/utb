<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model  {

	protected $table = 'universitys';

	public function researcher()
  {
    return $this->hasMany('App\Researcher');
  }
	public function expert()
	{
		return $this->hasMany('App\Expert');
	}
	public function center()
	{
    return $this->hasMany('App\Center');
  }
	public function area()
	{
    return $this->hasMany('App\Area');
  }

}
