<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Business;
use App\Category;

class BusinessesController extends Controller
{
 	public function index() 
 	{
 		// grabs a collection of categories and of unique quarters, ordered alphabetically, then sends them to the view
 		$categories = Category::all()->sortBy('name');
 		$quarters = Business::orderBy('quarter')->pluck('quarter')->unique()->reject(function($quarter){
 			return !$quarter;
 		});
 		return view('businesses.index', compact('categories', 'quarters'));
 	}   

 	public function search(Request $request)
 	{
 		$builder = Business::query();
 		if (Input::has('title')) {
 			$queryString = Input::get('title');
 			$builder->where('title', 'LIKE', "%{$queryString}%");
 		}
 		if (Input::has('category')) {
 			$builder->searchCategory(Input::get('category'));
 		}
 		if (Input::has('quarter')) 
 		{
 			$queryString = Input::get('quarter');
 			$builder->where('quarter', 'LIKE', "%{$queryString}%");
 		}
 		$results = $builder->paginate(10);

 		$categories = Category::all()->sortBy('name');
 		$quarters = Business::orderBy('quarter')->pluck('quarter')->unique()->reject(function($quarter){
 			return !$quarter;
 		});
 		return view('businesses.search', compact('results', 'categories', 'quarters'));
 	}

 	public function show(Business $id)
 	{
 		//concatenate address columns and  remove null entries to avoid gaps in address display
 		$address = array_filter([$id->address1, $id->address2, $id->town, $id->postcode]);

  		return view('businesses.show', compact('id','address'));
 	}
}
