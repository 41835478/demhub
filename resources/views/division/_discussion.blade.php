<div class="row">
	<div class="col-md-7 col-md-offset-2">
    <div class="row" >

			<h2><span class="label label-info" style="background-color:rgba(0, 0, 0, 0.7);">DISCUSSION</span><h2>
    </div>

    @foreach ($threads as $thread)
    <div class="row">
      <h3>
        <a
          @if(Auth::check())
            target="_blank" href="{{$thread->route}}"
          @else
            href="" data-toggle="modal" data-target="#myModal"
            @endif
        style="color:#000">
        {{$thread->title}}
        </a>
      </h3>
      <p>
        <b>LATEST POST:</b>
				<?php
				echo preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', nl2br(e($thread->getLastPostAttribute()->content)));
				?>
      </p>
    </div>
    @endforeach

  </div>
</div>
