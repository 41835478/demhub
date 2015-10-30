<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class PublicationController extends Controller
{

    /**
     * Create a new publication instance with a document attachment.
     *
     * @param  Array $attributes
     *
     * @return void
     */

    public function __construct(array $attributes = array()) {
        $this->middleware('auth', ['except' => 'index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $publications = Publication::all();
      return view(
        'frontend.user.dashboard.publication.index', compact(['publications'])
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.user.dashboard.publication.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publication = new Publication($request->all());
        Auth::user()->publications()->save($publication);

        return redirect('publications')
        ->withFlashSuccess("Successfully created publication!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $publication = Publication::findOrFail($id);
      return view(
        'frontend.user.dashboard.publication.show', compact(['publication'])
      );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $publication = Publication::findOrFail($id);
      return view(
        'frontend.user.dashboard.publication.edit', compact(['publication'])
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $publication = Publication::findOrFail($id);
      // TODO - update with $request

      return redirect('publications')
      ->withFlashSuccess("Successfully created publication!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
