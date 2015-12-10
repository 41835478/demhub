<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon as Carbon;

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
      $publications = Auth::user()->publications;

      return view(
        'frontend.user.dashboard.my_publication.index', compact(['publications'])
      );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.user.dashboard.my_publication.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $divisions="";
      for ($i = 1;$i < 7; $i++){
        $field='division_'.$i;
        if (! empty ($request->$field)){
        $divisions = $divisions.'|'.$request->$field;
      }
      }
      $divisions = $divisions.'|';

      $inputs = [
        'title' => $request->title,
        'description' => $request->description,
        'publication_author' => $request->author,
        'publication_date' => Carbon::createFromFormat('d/m/Y', $request->date),
        'privacy' => $request->privacy,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'volume' => $request->volume,
        'issues' => $request->issue,
        'pages' => $request->pages,
        'publisher' => $request->publisher,
        'institution' => $request->institution,
        'conference' => $request->conference,
      ];
        $publication = new Publication($inputs);

        Auth::user()->publications()->save($publication);

        return redirect('my_publications')
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
      $publications = Auth::user()->publications;
      $publication = Publication::findOrFail($id);
      return view(
        'frontend.user.dashboard.my_publication.show', compact(['publication','publications'])
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
        'frontend.user.dashboard.my_publication.edit', compact(['publication'])
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
      $divisions="";
      for ($i = 1;$i < 7; $i++){
        $field='division_'.$i;
        if (! empty ($request->$field)){
        $divisions = $divisions.'|'.$request->$field;
      }
      }
      $divisions = $divisions.'|';

      $inputs = [
        'title' => $request->title,
        'description' => $request->description,
        'publication_author' => $request->author,
        'publication_date' => Carbon::createFromFormat('d/m/Y', $request->date),
        'privacy' => $request->privacy,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'volume' => $request->volume,
        'issues' => $request->issue,
        'pages' => $request->pages,
        'publisher' => $request->publisher,
        'institution' => $request->institution,
        'conference' => $request->conference,
      ];
      Publication::updateOrCreate(['id'=>$id], $inputs);

      // $publication->fill($inputs)->save();

      return redirect('my_publications')
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

    /**
     * Display publications in main page
     *
     * @return \Illuminate\Http\Response
     */
    public function public_publication()
    {
        $publications = Publication::all();
        $secondMenu = true;
        // dd($publications);
        return view('frontend.user.publication_filter.publication_filter', compact([
          'publications', 'secondMenu'
        ]));
    }
}
