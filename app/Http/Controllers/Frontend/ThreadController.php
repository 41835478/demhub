<?php

namespace Riari\Forum\Frontend\Http\Controllers;

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
      $threads = $this->api('thread.index-new')->get()->simplePaginate(10);
      // orderBy('updated_at', 'desc');
      event(new UserViewingNew($threads));
      $categories = $this->categories->getAll();

      $allDivisions = Division::all();


      return View::make('forum::all_threads', compact('threads', 'categories', 'allDivisions'));
  }
}
