@extends('layouts.master')

@section('content')
<div id="user-likes" class="row">
	<div class="col-md-12">
    	<h1><i class="fa fa-thumbs-up"></i> Apps</h1>
    </div>

    <div class="col-md-12">
    	@if ($likes)
    		@foreach($likes as $like)
    			@if($like->getlikedapp)

    				<div class="col-md-12">
    					<hr>
						<div id="user-info" class="col-md-2">
							{!! HTML::image('images/user/'.$like->file_name.'',
							        ''.$like->getLikedAppUser->user_name.' icon',
							        array(
							          'class' => 'img-responsive img-circle'
							        )
							) !!}
							<h5><a href="#">{{$like->getLikedAppUser->user_name}}</a></h5>
						</div>
						<div class="col-md-10">
							<h4>{{$like->getLikedApp->app_name}}</h4>
							<section>
								<p>{{$like->getLikedApp->app_desc}}</p>
							</section>
						</div>


						<hr>

					</div>
    			@endif
    		@endforeach
    	@endif
    </div>

</div>

@endsection
