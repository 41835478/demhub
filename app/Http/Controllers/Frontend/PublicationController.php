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
use App\Models\Access\User\User;
use App\Models\ContentMedia;
use App\Http\Requests\Frontend\PublicationRequest;
use App\Http\Components\Search;

/**
 * Class PublicationController
 * @package App\Http\Controllers\Frontend
 */
class PublicationController extends Controller
{
    const FAVORITES_DEFAULT = 0;
	const VIEWS_DEFAULT = 1;

    // Follower and followed types
	// Including connections, bookmarks, tracking, etc.
	const ARTICLE       = 'A';
	const DIVISION      = 'D';
	const KEYWORD       = 'K';
	const LOCATION      = 'L';
	// const ORGANIZATION  = 'O'; // NOTE - Not yet in use
	const PUBLICATION   = 'P';
	const SCRAPE_SOURCE = 'S';
	const THREAD        = 'T';
	const USER          = 'U';

    /**
     * Create a new publication controller instance
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
        $caret = 000;

        return view(
            'frontend.user.dashboard.my_publication.index', compact(['publications','caret'])
        );
    }

    public function caret_publication_action($caret)
    {
      $caretAction = substr($caret, 0, 3);
      $parseCaret = substr($caret, 4);
      // $publications = Auth::user()->publications;

      $ids = array_filter(preg_split("/\|/", $parseCaret));
      if ($caretAction = "del"){
        foreach ($ids as $id){
            Publication::where('id', $id)
                        ->update(['deleted' => 1]);
        }
      }

      return redirect('my_publications')
            ->withFlashSuccess("Publication(s) deleted");
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

        // TODO - check 'status' to see if increment happened successfully
        // $status should be true
        $status = $publication->incrementViewCount();

        return view(
            'frontend.user.dashboard.my_publication.view', compact(['publication'])
        );
    }

    public function edit($id)
    {
        $divisions = Division::all();
        $publication = Publication::findOrFail($id);
        $pubUploaderId = $publication->uploader->id;

        // FIXME Move authorization if statement to request section
        if ($pubUploaderId == Auth::user()->id){
            return view(
                'frontend.user.dashboard.my_publication.edit', compact(['publication', 'divisions'])
            );
        } else {
            return view(
                'frontend.user.dashboard.my_publication.view', compact(['publication', 'divisions'])
            );
        };
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        $publication = new Publication;

        return view('frontend.user.dashboard.my_publication.new', compact(['divisions','publication']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $divisions = "";
      for ($i = 1;$i < 7; $i++){
        $field = 'division_'.$i;
        if (!empty($request->$field))
            $divisions = $divisions.'|'.$request->$field;
      }
      $divisions = $divisions.'|';

      $data = json_encode([
          $request->volume,
          $request->issues,
          $request->pages,
          $request->publisher,
          $request->institution,
          $request->conference,
          $request->publication_author,
          FAVORITES_DEFAULT,
          VIEWS_DEFAULT
      ]);

      $inputs = [
        'name' => $request->name,
        'description' => $request->description,
        'data' => $data,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'visibility' => $request->visibility,
        'owner_id' => Auth::user()->id,
        'deleted' => 0,
        'publish_date' => Carbon::createFromFormat('d/m/Y', $request->publication_date),
      ];

      $publication = new Publication($inputs);
      $publication->save();

      if ($request->document) {
          $contentMediaData = [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => $request->document,
              'content_id' => $publication->id
          ];

          $contentMedia = new ContentMedia($contentMediaData);
          $contentMedia->save();
      }

      return redirect('my_publications')
            ->withFlashSuccess("Publication created successfully!");
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
        $field = 'division_'.$i;
        if (!empty($request->$field)) {
            $divisions = $divisions.'|'.$request->$field;
        }
      }
      $divisions = $divisions.'|';

      $inputs = [
        'name' => $request->name,
        'description' => $request->description,
        'divisions' => $divisions,
        'keywords' => $request->keywords,
        'visibility' => $request->visibility,
        'owner_id' => Auth::user()->id,
        'deleted' => 0,
        'publish_date' => Carbon::createFromFormat('d/m/Y', $request->publication_date),
      ];

      $publication = Publication::updateOrCreate(['id'=>$id], $inputs);

      $data = json_encode([
          $request->volume,
          $request->issues,
          $request->pages,
          $request->publisher,
          $request->institution,
          $request->conference,
          $request->publication_author,
          $publication->favorites(),
          $publication->views()
      ]);

      $publication->data = $data;
      $publication->save();

      if ($request->document) {
          $contentMediaData = [
              'description' => NULL,
              'view_order' => 0,
              'deleted' => false,
              'resource' => $request->document,
              'content_id' => $publication->id
          ];

          $contentMedia = new ContentMedia($contentMediaData);
          $contentMedia->save();
      }

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
        // $publications = Publication::where('deleted', 0)
        //                             ->where('visibility',1)
        //                             ->orderBy('id','DESC')
        //                             ->get();
        $results = Search::queryPublications();
        $results_hits = $results['hits'];
        $publications = Search::formatElasticSearchToArray($results_hits);
        $secondMenu = true;
        $keywords = [];
        $allDivisions = Division::all();
        $type='teaser';
        return view('frontend.user.publication_filter.public_journal', compact([
          'publications', 'secondMenu','keywords','allDivisions','type'
        ]));
    }

    // TODO - create alternate function equivalent for
    // ->references('id')->on( {{ followed_type }} )->onDelete('cascade');
    public function bookmarkPublication($pubId) {
		if (!Auth::user()->has_bookmarked_publication($pubId)) {
			Auth::user()->publicationBookmarks()->attach($pubId, [
                'follower_type' => self::USER, 'followed_type' => self::PUBLICATION
            ]);
		}

		$users = User::where('id', '!=', Auth::id())
									->where('user_name', '!=', 'demhub')
									->orderBy('id','DESC')->get();

		$publications = Publication::all();

		return view('frontend.user.dashboard.bookmarks', compact([
					'users', 'publications'
		]));
	}

	public function unbookmarkPublication($pubId) {
		if (Auth::user()->has_bookmarked_publication($pubId)) {
			Auth::user()->following()->detach($pubId, [
                'follower_type' => self::USER, 'followed_type' => self::PUBLICATION
            ]);
		}

        $users = User::where('id', '!=', Auth::id())
									->where('user_name', '!=', 'demhub')
									->orderBy('id','DESC')->get();

		$publications = Publication::all();

		return view('frontend.user.dashboard.bookmarks', compact([
					'users', 'publications'
		]));
	}
}
