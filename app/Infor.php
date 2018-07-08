<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Infor extends Model  {

	//protected $fillable = ['researcher_id', 'title', 'file', 'cload'];
	//protected $garded = ['id'];
	protected $table = 'infors';

	public function user()
  {
    return $this->belongsTo('App\User');
  }


}
