
@extends('frontend.layouts.master')

@section('content')
<?php

?>

	<div class="row">
		<div class="col-md-12">
			<!-- {!! HTML::image('images/user/'.$user_avatar->image.'',
			        ''.Auth::user()->user_name.' icon',
			        array(
			          'class' => 'user-icon img-responsive img-thumbnail'
			        )
			) !!} -->

	    	<h1></h1>
	        <hr>
	    </div>
	    <div class="row text-center">
			
		</div>
		
		<div class="row" style="padding:2%;">
			<div class="col-md-12">
				
			</div>
		</div>
		
	    <div class="col-md-12 text-right">
			<h5>Arrange by</h5>
			<ul class="list-inline">
				<li>
					<a href="{{URL::route('arrange-likes')}}">
						<i class="fa fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" title="Likes"></i>
					</a>
				</li>
				<li>
					<a href="{{URL::route('arrange-dislikes')}}">
						<i class="fa fa-thumbs-down" data-toggle="tooltip" data-placement="bottom" title="Dislikes"></i>
					</a>
				</li>
				<li>
					<a href="{{URL::route('arrange-comments')}}">
						<i class="fa fa-commenting" data-toggle="tooltip" data-placement="bottom" title="Comments"></i>
					</a>
				</li>
			</ul>
		</div>
		

</div>



@endsection('content')

