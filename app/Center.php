<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model  {
	protected $fillable = ['name', 'university_id', 'address'];
	protected $garded = ['id'];

	public function university()
	{
		return $this->belongsTo('App\University');
	}
	public function area()
  {
    return $this->hasMany('App\Area');
  }

}
