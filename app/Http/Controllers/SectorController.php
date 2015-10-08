<?php namespace App\Http\Controllers;

use App\Models\Sector;
use App\Http\Controllers\Controller;

class SectorController extends Controller
{
    /**
    * Show a list of all available sectors.
    *
    * @return Response
    */
    public function index()
    {
      $sectors = Sector::all();

      return view('sector.index', [
        'sectors' => $sectors
      ]);
    }
}
