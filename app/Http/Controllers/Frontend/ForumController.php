<?php namespace App\Http\Controllers\Frontend;
use App;
use Config;
use Event;
use Input;
use Illuminate\Routing\Controller;
use Redirect;
use Riari\Forum\Events\ThreadWasViewed;
use Riari\Forum\Repositories\Categories;
use Riari\Forum\Repositories\Threads;
use Riari\Forum\Repositories\Posts;
use Riari\Forum\Libraries\AccessControl;
use Riari\Forum\Libraries\Alerts;
use Riari\Forum\Libraries\Utils;
use Riari\Forum\Libraries\Validation;
use Route;
use View;
use Validator;
use Auth;
use App\Models\Division;
use Riari\Forum\Models\Thread;
use Riari\Forum\Models\Category;
use Riari\Forum\Controllers\BaseController;
use App\Http\Components\Search;

/* Autogenerated Forum Controller */
/* Hook point of the Forum package inside your laravel application */
/* Feel free to override methods here to fit your requirements */

/**
 * Class ArticleController
 * @package App\Http\Controllers\Frontend
 */
class ForumController extends BaseController
{
	public function getViewAllThreads()
	{
			// $threads = Thread::orderBy('updated_at', 'desc')->simplePaginate(10);
			$results = Search::queryDiscussions();
			$results_hits = $results['hits'];
			$threads = Search::formatElasticSearchToArray($results_hits);

			$categories = Category::all();

			$allDivisions = Division::all();


			return View::make('forum::all_threads', compact('threads', 'categories','allDivisions'));
	}
	protected function makeView($name)
	{
		$allDivisions = Division::all();

		return View::make($name)->with($this->collections)->with('allDivisions', $allDivisions);
	}

	public function getViewIndex()
	{
		$allDivisions = Division::all();
		$categories = Category::all();

		return View::make('forum::index', compact('categories', 'allDivisions'));
	}
	public function getViewThread($categoryID, $categoryAlias, $threadID, $threadAlias)
	{
			$allDivisions = Division::all();
			$this->load(['category' => $categoryID, 'thread' => $threadID]);

			Event::fire(new ThreadWasViewed($this->collections['thread']));

			return $this->makeView('forum::thread', compact('allDivisions'));
	}

	public function getModCreateThread()
	{
			$allDivisions = Division::all();
			$categories = Category::where('category','=','9');

			return $this->makeView('forum::thread-create', compact('allDivisions'));
	}

	public function postModCreateThread()
	{
			$user = Utils::getCurrentUser();


			$thread_valid = Validation::check('thread');
			$post_valid = Validation::check('post');

			if (Input::get('title'))
			{
					$thread = array(
							'author_id'       => $user->id,
							'parent_category' => Input::get('division_selection'),
							'title'           => Input::get('title')
					);

					$thread = $this->threads->create($thread);

					$post = array(
							'parent_thread'   => $thread->id,
							'author_id'       => $user->id,
							'content'         => Input::get('content')
					);

					$this->posts->create($post);

					Alerts::add('success', trans('forum::base.thread_created'));

					return Redirect::to($thread->route);
			}
			else
			{
					return Redirect::to($this->collections['category']->newThreadRoute)->withInput();
			}
	}
	
	// public function showDiscussionIndex(){
//
// 		return view('vendor.forum.index', [
// 			]);
// 	}
// 	public function postDiscussion(){
// 		if (Request::isMethod('post')){
// 			$title = Input::get('title');
// 			$description = Input::get('description');
// 			$category = Input::get('category');
// 			$discussion = new forum_threads;
// 			$discussion->author_id = Auth::user()->id;
// 			$discussion->parent_category = $divison;
// 			$discussion->title = $title;
// 			$discussion->hidden = false;
// 			$discussion->updated_at = app('currentDT');
// 			$discussion->created_at = app('currentDT');
// 			$discussion->save();
//
// 			return Redirect::route('discussion');
//
// 		}
// 		else {
// 			return Redirect::route('home');
// 		}
// 	}
//
// 	public function showDiscussion($id){
// 		$discussion = forum_threads::where('id', '=', $id)
// 									->first();
// 		if ($discussion){
// 			return View::make('discussion.view')
// 						->with('discussion', $discussion);
// 		}
// 		else {
// 			return Redirect::back();
// 		}
// 	}
//
// 	public function postReply($id){
// 		if (Request::isMethod('post')){
// 			$reply_create = new Reply;
// 			$reply_create->author_id = Auth::user()->id;
// 			$reply_create->forum_threads_id = $id;
// 			$reply_create->content = Input::get('reply');
// 			$reply_create->hidden = false;
// 			$reply_create->updated_at = app('currentDT');
// 			$reply_create->updated_at = app('currentDT');
// 			$reply_create->save();
//
// 			$forum_threads = forum_threads::where('id','=',$id)
// 										->update(array(
// 												'updated_at' => app('currentDT'),
// 												));
//
// 			return Redirect::back();
// 		}
// 		else {
//
// 		}
// 	}

}
