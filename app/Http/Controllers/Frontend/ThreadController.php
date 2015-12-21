<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Riari\Forum\Frontend\Events\UserViewingCategory;
use Riari\Forum\Frontend\Events\UserViewingIndex;
use Riari\Forum\Frontend\Support\Forum;

use Illuminate\Http\RedirectResponse;
use Riari\Forum\Frontend\Events\UserCreatingThread;
use Riari\Forum\Frontend\Events\UserMarkingNew;
use Riari\Forum\Frontend\Events\UserViewingNew;
use Riari\Forum\Frontend\Events\UserViewingThread;

class ThreadController extends BaseController
{
  public function getViewAllThreads()
  {
      $threads = $this->api('thread.index-new')->orderBy('updated_at', 'desc')->simplePaginate(10);
      // orderBy('updated_at', 'desc');
      event(new UserViewingNew($threads));
      $categories = $this->categories->getAll();

      $allDivisions = Division::all();


      return View::make('forum::all_threads', compact('threads', 'categories', 'allDivisions'));
  }
  public function getModCreateThread()
	{
			$allDivisions = Division::all();
      $category = $this->api('category.fetch', $request->route('category'))->get();
			// $this->load(['category' => 9]);

      if (!$category->threadsEnabled) {
          Forum::alert('warning', 'categories.threads_disabled');

          return redirect(Forum::route('category.show', $category));
      }

      event(new UserCreatingThread($category));

      return view('forum::thread.create', compact('category','allDivisions'));

			// return $this->makeView('forum::thread-create', compact('allDivisions'));
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
}
