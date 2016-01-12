<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;
use App\Http\Requests\Frontend\PublicationRequest;

/**
 * Class PublicationController
 * @package App\Http\Controllers\Frontend
 */
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
      $publications = Publication::where('deleted','!=',1)->where('user_id','=',Auth::user()->id)->orderBy('id','DESC')->get();
      $caret = 000;
      return view(
        'frontend.user.dashboard.my_publication.index', compact(['publications','caret'])
      );
    }
    public function caret_publication_action($caret)
    {
      $caretAction=substr($caret, 0, 3);
      $parseCaret=substr($caret, 4);
      // $publications = Auth::user()->publications;

      $ids = array_filter(preg_split("/\|/", $parseCaret));
      if ($caretAction="del"){
        foreach ($ids as $id){
            Publication::where('id', $id)
                        ->update(['deleted' => 1]);
        }
      }

      return redirect('my_publications')
      ->withFlashSuccess("Publication(s) deleted");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user =Auth::user();
        return view('frontend.user.dashboard.my_publication.new', compact(['user'])
      );
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
        'publication_date' => Carbon::createFromFormat('d/m/Y', $request->publication_date),
        'document' => $request->document,
        'privacy' => $request->privacy,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'volume' => $request->volume,
        'issues' => $request->issue,
        'pages' => $request->pages,
        'publisher' => $request->publisher,
        'institution' => $request->institution,
        'conference' => $request->conference,
        'deleted' => 0,
        'views' => 1,
        'favorites' => 0,
      ];
        $publication = new Publication($inputs);

        Auth::user()->publications()->save($publication);

        return redirect('my_publications')
        ->withFlashSuccess("Publication created successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
      $caret = 000;
      $publications = Publication::where('deleted','!=',1)->where('user_id','=',Auth::user()->id)->orderBy('id','DESC')->get();
      $publication = Publication::findOrFail($id);
      return view(
        'frontend.user.dashboard.my_publication.preview', compact(['publication','publications', 'caret'])
      );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function view($id)
     {

       $publication = Publication::findOrFail($id);
       Publication::where('id', $id)
                   ->update(['views' => ($publication->views+1)]);

       return view(
         'frontend.user.dashboard.my_publication.view', compact(['publication'])
       );
     }

    public function edit($id)
    {
      $publication = Publication::findOrFail($id);
      $pubUploaderId = $publication->uploader->id;
      // FIXME Move authorization if statement to request section
      if ($pubUploaderId==Auth::user()->id){

      return view(
        'frontend.user.dashboard.my_publication.edit', compact(['publication'])
      );
      }
      else {
        return view(
          'frontend.user.dashboard.my_publication.view', compact(['publication'])
        );
      };
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
        'document' => $request->document,
        'publication_date' => Carbon::createFromFormat('d/m/Y', $request->publication_date),
        'privacy' => $request->privacy,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'volume' => $request->volume,
        'issues' => $request->issue,
        'pages' => $request->pages,
        'publisher' => $request->publisher,
        'institution' => $request->institution,
        'conference' => $request->conference
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
        $publications = Publication::where('deleted','!=',1)->where('visibility','!=',0)->orderBy('id','DESC')->get();
        $secondMenu = true;
        // dd($publications);
        return view('frontend.user.publication_filter.public_journal', compact([
          'publications', 'secondMenu',
        ]));
    }
}
