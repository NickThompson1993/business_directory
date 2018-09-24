<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Business extends Model
{

	protected $with = [
		'categories',
		'hours'
	];

	protected $fillable = [
		'title',
		'body',
		'tripadvisor',
		'quarter',
		'address1',
		'address2',
		'town',
		'postcode',
		'longitude',
		'latitude',
		'phone',
		'website',
		'facebook',
		'instagram',
		'twitter',
		'youtube'
	];

    public function hours()
    {
    	return $this->hasOne(BusinessHours::class);
    }

    public function categories() {
    	return $this->belongsToMany(Category::class);
    }

    public function scopeSearchCategory ($query, $category)
    {
    	$query->whereHas('categories', function($catQuery) use($category){
    		$catQuery->where('name', 'LIKE' , "%{$category}%");
    	});
    }
}
