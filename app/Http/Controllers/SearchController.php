<?php

namespace DEMHub\Http\Controllers;

use Illuminate\Http\Request;
use DEMHub\Http\Requests;
use DEMHub\Http\Controllers\Controller;

class SearchController extends Controller {

	public function searchTerm(){
		//print_r(Input::all());
		$search = Request::input('search');
		//echo $search;
		$feed = Xmlcategoryfeed::where('title', 'like', '%'.$search.'%')
								->orWhere('desc', 'like', '%'.$search.'%')
								->orWhere('keywords', 'like', '%'.$search.'%')
								->orderBy('pubDate', 'desc')
								->paginate(15);
		$cat = Xmlcategories::all();

		return view('discover.search')
					->with('categories', $feed)
					->with('cats', $cat);
	}
}
