<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model  {

	protected $table = 'activitys';
	public function organize()
  {
    return $this->belongsTo('App\Organize');
  }
}
