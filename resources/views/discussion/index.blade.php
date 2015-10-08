@extends('layouts.master')

@section('content')
	<div id="conversation" class="row">
		<div class="col-md-12">
			<h1>Discussion <hr></h1>
		</div>
	</div>
	<div id="conversation-head" class="row" style="background: url('images/backgrounds/shutterstock_130635224.jpg') fixed center center no-repeat;">
		<div class="col-md-12 text-center">
			<button class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-lg">Start a Conversation</button>
		</div>
	</div>
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Start A Conversation</h4>
			</div>
			<div class="modal-body">
				@include('forms.discuss')
			</div>
	    </div>
	  </div>
	</div>

	<div class="row" style="padding:2%;">
		<div class="col-md-12">
			@include('discussion.menu.xmlcategories')
		</div>
		@foreach($discussions as $discussion)
			<div class="col-md-12">
				<div class="col-md-1 text-center">
					{!! HTML::image('images/user/'.$discussion->getUser->avatar->file_name.'',
				        ''.$discussion->getUser->user_name.' icon',
				        array(
				          'class' => 'user-icon img-responsive img-circle center-block',
				          'style' => 'border:1px solid #CCC; padding:1px; bakground:#FFF;',
				          'width' => '60',
				        )
					) !!}
					<h5>{{$discussion->getUser->user_name}}</h5>
				</div>
				<div class="col-md-6">
					<h4>
						<a href="{{url('discussion-convo', array('id' => $discussion->id))}}">
							{{$discussion->discussion_title}}
						</a>
					</h4>
					<span class="badge" style="background-color:#{{$discussion->getCategory->bg_color}}; color:#FFF; padding:5px;">{{str_replace("<br>", " ", $discussion->getCategory->category_name)}}</span><br>
					<span class="text-info"><small>Last updated {{date("j\\t\\h F, Y \a\\t g:i a", strtotime($discussion->updated_at))}}</small></span>

					<hr>
				</div>
				<div class="col-md-2">

					<p class="lead text-center">
						@if(!$discussion->getReplies->isEmpty())
							@if(count($discussion->getReplies) == 1)
								{{count($discussion->getReplies)}}<br><small>Reply</small>
							@else
								{{count($discussion->getReplies)}}<br><small>Replies</small>
							@endif

						@else
							0<br><small>Replies</small>
						@endif

					</p>

				</div>
			</div>
		@endforeach
	</div>


@endsection('content')
