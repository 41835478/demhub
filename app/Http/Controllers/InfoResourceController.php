<?php namespace App\Http\Controllers;

use App\Models\InfoResource;
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
}
