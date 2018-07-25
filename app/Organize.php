<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Organize extends Model  {

	protected $table = 'organizes';

	public function amphur()
	{
		return $this->belongsTo('App\Amphur');
	}
	public function village()
  {
    return $this->hasMany('App\Village');
  }
	public function person()
  {
    return $this->hasMany('App\Person');
  }
	public function activity()
	{
		return $this->hasMany('App\Activity');
	}
	public function tourist()
	{
		return $this->hasMany('App\Tourist');
	}
}
