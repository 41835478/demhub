@extends('frontend.layouts.master')

@section('content')
<style>

</style>
	<div id="discover-apps" class="row">
		<div class="col-md-12">
			<h2 style="margin-top:0;">{{$discussion->discussion_title}}</h2>
			<span class="badge" style="background-color:#{{$discussion->getCategory->bg_color}}; color:#FFF; padding:5px;">{{str_replace("<br>", " ", $discussion->getCategory->category_name)}}</span>
			<hr>
		</div>
		<div class="col-md-12">
			<div class="col-md-1 text-center">
				{{HTML::image('images/user/'.$discussion->getUser->avatar->file_name.'', 
				    ''.$discussion->getUser->user_name.' icon', 
				    array(
				      'class' => 'user-icon img-responsive img-circle center-block',
				      'style' => 'border:1px solid #CCC; padding:1px; bakground:#FFF;',
				      'width' => '60',
				    )
				)}}
				<h5>{{$discussion->getUser->user_name}}</h5>
			</div>
			<div class="col-md-11">
				<p>{{$discussion->discussion_paragraph}}</p>
				<span class="text-info"><small>{{date("j\\t\\h F, Y \a\\t g:i a", strtotime($discussion->created_at))}}</small></span>
			</div>
		</div>
		@foreach($discussion->getReplies as $reply)

			<div class="col-md-12">
				<hr>
				<div class="col-md-1 text-center">
					{{HTML::image('images/user/'.$reply->getUser->avatar->file_name.'', 
					    ''.$reply->getUser->user_name.' icon', 
					    array(
					      'class' => 'user-icon img-responsive img-circle center-block',
					      'style' => 'border:1px solid #CCC; padding:1px; bakground:#FFF;',
					      'width' => '60',
					    )
					)}}
					<h5>{{$reply->getUser->user_name}}</h5>
				</div>
				<div class="col-md-11">
					<p>{{$reply->reply_paragraph}}</p>
					<span class="text-info"><small>{{date("j\\t\\h F, Y \a\\t g:i a", strtotime($reply->updated_at))}}</small></span>
				</div>
			</div>
		@endforeach
		<div class="col-md-12">
			<hr>
			<div class="col-md-2 text-center">
				{{HTML::image('images/user/'.Auth::user()->avatar->file_name.'', 
				    ''.Auth::user()->user_name.' icon', 
				    array(
				      'class' => 'user-icon img-responsive img-circle center-block',
				      'style' => 'border:1px solid #CCC; padding:1px; bakground:#FFF;',
				      'width' => '60',
				    )
				)}}
				<h5>{{Auth::user()->user_name}}</h5>
			</div>
			<div class="col-md-10">
				@include('forms.user.reply')
			</div>
		</div>

	</div>

	
@endsection('content')