<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model  {

	//protected $fillable = ['researcher_id', 'title', 'file', 'cload'];
	//protected $garded = ['id'];
	protected $table = 'downloads';
	public function organize()
  {
    return $this->belongsTo('App\Organize');
  }
}
