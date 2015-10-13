<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\InfoResource;
use App\Models\Region;
use App\Http\Controllers\Controller;

class InfoResourceController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
      $resources = InfoResource::all();

      return view('resource.index', [
        'resources' => $resources
      ]);
    }
	public function showResourceFilter(){
		$regions= Region::all();
		$InfoResource= InfoResource::all();
		$categories = Division::all();
		
		return view('frontend.user.resource_filter', [
					
					'AllDivisions' =>  $categories,	
					'resourceRelation'  => $regions,
					'resourceEntry' =>  $InfoResource]);
					
	}
}
