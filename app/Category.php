<?php
namespace App;

use App\Business;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	
	protected $fillable = [
		'name'
	];

	public function businesses() {
		return $this->belongsToMany(Business::class);
	}
}