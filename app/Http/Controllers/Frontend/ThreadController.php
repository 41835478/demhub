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

use Riari\Forum\Controllers\BaseController;

class ThreadController extends BaseController
{
  public function getViewAllThreads()
  {
      $threads = $this->api('thread.index-new')->orderBy('updated_at', 'desc')->simplePaginate(10);
      dd($threads);
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
      $category = $this->api('category.fetch', $request->route('category'))->get();

      if (!$category->threadsEnabled) {
          Forum::alert('warning', 'categories.threads_disabled');

          return redirect(Forum::route('category.show', $category));
      }

      $thread = [
          'author_id'        => auth()->user()->id,
          'category_id'      => $category->id,
          'title'            => $request->input('title'),
          'parent_category'  => $request->input('division_selection'),
          'content'          => $request->input('content')
      ];

      $thread = $this->api('thread.store')->parameters($thread)->post();

      Forum::alert('success', 'threads.created');

      return redirect(Forum::route('thread.show', $thread));
  }
}
