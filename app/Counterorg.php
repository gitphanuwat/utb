<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Counterorg extends Model  {

	protected $table = 'counterorgs';
	public function organize()
  {
    return $this->belongsTo('App\Organize');
  }
}
