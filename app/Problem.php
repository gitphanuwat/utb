<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model  {


	protected $table = 'problems';


	public function area()
  {
    return $this->belongsTo('App\Area');
  }
	public function taggroup()
	{
		return $this->belongsTo('App\Taggroup');
	}
}
