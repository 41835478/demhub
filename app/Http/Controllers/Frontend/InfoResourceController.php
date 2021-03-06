<?php namespace App\Http\Controllers\Frontend;

use App\Models\Division;
use App\Models\InfoResource;
use App\Models\Region;
use App\Http\Controllers\Controller;

/**
 * Class InfoResourceController
 * @package App\Http\Controllers\Frontend
 */
class InfoResourceController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
        $regions        = Region::all();
        $infoResource   = InfoResource::all();
        $categories     = Division::all();

        return view('frontend.user.resource_filter.index', [
            'allDivisions'      => $categories,
            'resourceRelation'  => $regions,
            'resourceEntry'     => $infoResource
        ]);
    }
}
