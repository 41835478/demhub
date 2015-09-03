@extends('structure.main')

@section('content')
<div id="user-likes" class="row">
	<div class="col-md-12">
    	<h1><i class="fa fa-heart"></i> Apps</h1>
    </div>

    <div class="col-md-12">
    	@if ($favourites)
    		@foreach($favourites as $favourite)
    			@if($favourite->getfavouritedapp)
    				
    				<div class="col-md-12">
    					<hr>
						<div id="user-info" class="col-md-2">
							{{HTML::image('images/user/'.$favourite->file_name.'', 
							        ''.$favourite->getfavouritedAppUser->user_name.' icon', 
							        array(
							          'class' => 'img-responsive img-circle'
							        )
							)}}
							<h5><a href="#">{{$favourite->getfavouritedAppUser->user_name}}</a></h5>
						</div>
						<div class="col-md-10">
							<h4>{{$favourite->getfavouritedApp->app_name}}</h4>
							<section>
								<p>{{$favourite->getfavouritedApp->app_desc}}</p>
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