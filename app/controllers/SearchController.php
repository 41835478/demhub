<?php

class SearchController extends BaseController {

	public function searchTerm(){
		//print_r(Input::all());
		$search = Input::get('search');
		//echo $search;
		$feed = Xmlcategoryfeed::where('title', 'like', '%'.$search.'%')
								->orWhere('desc', 'like', '%'.$search.'%')
								->orWhere('keywords', 'like', '%'.$search.'%')
								->orderBy('pubDate', 'desc')
								->paginate(15);
		$cat = Xmlcategories::all();

		return View::make('discover.search')
					->with('categories', $feed)
					->with('cats', $cat);
	}
}
