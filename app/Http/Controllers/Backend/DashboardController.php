<?php namespace App\Http\Controllers\Backend;

use App\Http\Components\ScraperComponent;
use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Keyword;
use App\Models\ScrapeSource;
use Illuminate\Http\Request;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('backend.dashboard');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function keywords(Request $request)
	{
		if($request->input("submit", "") == "save"){
			if($request->input("id") == 0){
				$keyword = new Keyword();
			} else {
				$keyword = Keyword::find($request->input("id"));
			}

			$keyword->divisions = ScraperComponent::convertDBArrayToString($request->input("div", ""));
			$keyword->keyword = $request->input("keyword");
			$keyword->weight = $request->input("weight");
			if($keyword->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}
		if($request->input("submit", "") == "x"){
			$keyword = Keyword::find($request->input("id"));
			$keyword->delete();
			$request->session()->flash('status', 'Deleted.');
		}
		$items = Keyword::orderBy('id', 'DESC')->get();
		$divisions = Division::all();

		return view('backend.keywords', compact('items', 'divisions'));
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function sources(Request $request)
	{
		if($request->input("submit", "") == "save"){
			if($request->input("id") == 0){
				$item = new ScrapeSource();
			} else {
				$item = ScrapeSource::find($request->input("id"));
			}
			$item->type = $request->input("type", "");
			$item->title = $request->input("title");
			$item->url = $request->input("url");
			if($item->save()){
				$request->session()->flash('status', 'Success');
			} else {
				$request->session()->flash('status', 'Failed!');
			}
		}
		if($request->input("submit", "") == "x"){
			$item = ScrapeSource::find($request->input("id"));
			$item->delete();
			$request->session()->flash('status', 'Deleted.');
		}

		$items = ScrapeSource::orderBy('id', 'DESC')->get();
		$divisions = Division::all();

		return view('backend.sources', compact('items', 'divisions'));
	}

}
