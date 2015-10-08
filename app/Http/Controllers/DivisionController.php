<?php namespace App\Http\Controllers;

use App\Models\Division;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    /**
    * Show a list of all available divisions.
    *
    * @return Response
    */
    public function index()
    {
      $divisions = Division::all();

      return view('division.index', [
        'divisions' => $divisions
      ]);
    }

    public function show($divisionId)
    {
      $divisions = Division::all();
      $division = Division::where('slug', $divisionId)->firstOrFail();

      return view('division.show', [
        'divisions' => $divisions,
        'division' => $division
      ]);
    }
}
