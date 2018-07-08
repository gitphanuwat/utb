<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggroup extends Model  {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'taggroups';
	//protected $fillable = ['name', 'detail'];
	//protected $garded = ['id'];

	public function expertlist()
  {
    return $this->hasMany('App\Expertlist');
  }
	public function research()
  {
    return $this->hasMany('App\Research');
  }
	public function paper()
  {
    return $this->hasMany('App\Paper');
  }
	public function problem()
  {
    return $this->hasMany('App\Problem');
  }
	public function creative()
  {
    return $this->hasMany('App\Creative');
  }
}
