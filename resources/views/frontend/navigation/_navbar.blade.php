<nav id="top-menu" class="navbar navbar-default navbar-inverse navbar-fixed-top">
	{{-- style="padding-left:30px;" --}}
	<div class="container-fluid">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

				<div class="nav-top-adjust">
					<a href="{{url('')}}" class="">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'max-width:150px')) !!}</a>

				</div>
		</div>

		<div class="collapse navbar-collapse col-md-offset-1 col-sm-offset-1" id="navbar-collapse-1">
			<ul class="navbar" style="margin-bottom:-8px">

							@if(isset($searchBar))
							<li class="col-md-8 col-sm-7 nav-top-adjust">
								<div class="input-group">
									{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
										{!! Form::text('query_term', (isset($query_term)) ? $query_term : NULL, ['class' => 'form-control nav-searchbar', 'placeholder' => 'Search','style' => '']) !!}
									{!! Form::close() !!}
								</div>
							@elseif (Auth::user())
							<li class="col-md-8 col-sm-7 nav-top-adjust" style="">

								{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
								<div class="form-group" style="padding-left:50px">
									<div class="input-group searchbar-group">
										<span class="input-group-addon nav-search-text">All<i class="fa fa-chevron-down"></i></span>
										{!! Form::text('query_term', (isset($query_term)) ? $query_term : NULL, ['class' => 'form-control nav-searchbar', 'placeholder' => 'Search','style' => '']) !!}
										<span class="input-group-addon nav-search-icon-style" style=""><i class="fa fa-search"></i></span>
									</div>
								</div>
								{!! Form::close() !!}

							@endif

				</li>
				@if (Auth::guest())
					<li class=
						@if (Request::url() === url('about'))
						 "active col-md-1 col-sm-1 nav-middle"
						@endif
					"col-md-1 col-sm-1 nav-middle"><a href="{{url('about')}}">{!! trans('ABOUT') !!}</a></li>

					<li class=
						@if (Request::url() === url('auth/register'))
						 "active nav-middle"
						@endif
					"col-md-2 col-sm-2 nav-middle"><a href="{{url('auth/register')}}">{!! trans('JOIN NOW') !!}</a>
					</li>

				@elseif(Auth::user())

				@endif


			<ul class="navbar-nav navbar-right navbar-style nav-top-adjust" style="display:inline;margin-top:-5px">

				{{-- <li
				@if (Request::url() === url('public_journal'))
				 class="active"
				@endif
				><a href="{{url('public_journal')}}" class="" style="">

						<h3 class="glyphicon glyphicon-folder-close" style="margin: 0 auto;padding-left:13px;margin-top:-17px;"></h3>

					<p style="font-size:55%">{!! trans('PUBLICATIONS') !!}<p>
				</a>

				</li> --}}
				<li
				@if (Request::url() === url('resource_filter'))
				 class="active"
				@endif
				>
				<a href="{{url('resource_filter')}}">
					<h2 class="glyphicon glyphicon-book" style="margin: 0 auto;padding-left:13px;font-size:215%"></h2>
					<p style="font-size:55%;">{!! trans('RESOURCES') !!}<p>
				</a>


				</li>
				<li
				@if (strpos(Request::url(), 'forum') ==true)
				 class="active"
				@endif
				style="margin-top:-5px"><a href="{{url('forum/all_threads')}}">
					<i class="fa fa-comments fa-3x" style="margin: 0 auto;padding-left:13px;"></i>
					<p style="font-size:55%;margin-top:-2px">{!! trans('DISCUSSIONS') !!}<p>
				</a>

				</li>

				@if (Auth::guest())
					<li
						@if (Request::url() === url('auth/login'))
							class="active"
						@endif
						>{!! link_to('auth/login', trans('LOGIN')) !!}</li>
				@else



					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase; padding-left:8px;">
							<img class="img-circle" style="height:35px;width:35px;display:inline;background:url({{Auth::user()->avatar->url('thumb')}});">

							<p style="font-size:55%;text-align:center;padding-left:11px">{{ Auth::user()->first_name}}<span class="caret"></span></p>

						</a>

						<ul class="dropdown-menu navbar-inverse user-dropdown" role="menu">
						  	@include('frontend.navigation._user-dashboard-sidebar')
						</ul>
					</li>

				@endif

			</ul>
			</ul>

		</div>
	</div>
</nav>
<script>
$("input[type=text]").focus(function() {
		$(".nav-searchbar").attr("style","color: #ed6b00;background-color:#fff;");
    $(".nav-search-icon-style").attr("style","background-color: #fff;color: #ed6b00;");
		$(".nav-search-text").attr("style","background-color: #ededed;color: #ed6b00;");
});

$(".searchbar-group").mouseenter(function() {
		$(".nav-searchbar").attr("style","color: #ed6b00;background-color:#fff;");
		$(".nav-search-icon-style").attr("style","background-color: #fff;color: #ed6b00;");
		$(".nav-search-text").attr("style","background-color: #ededed;color: #ed6b00;");
});
$("#top-menu li a").mouseenter(function() {
		$(this).children("img").attr("style","background:linear-gradient(rgba(237, 107, 0, 0.5), rgba(237, 107, 0, 0.5)),url({{Auth::user()->avatar->url('thumb')}});height:35px;width:35px;display:inline;");
});
$("#top-menu li a").mouseleave(function() {
		$(this).children("img").attr("style","height:35px;width:35px;display:inline;background:url({{Auth::user()->avatar->url('thumb')}});");
});
$("#top-menu").mouseleave(function() {
		$(".nav-searchbar").attr("style","background-color:#546f7a;");
    $("input[type=text]").siblings(".nav-search-icon-style").attr("style","background-color: #546f7a;color: #fff;");
		$("input[type=text]").siblings(".nav-search-text").attr("style","background-color:#455a63;color:#fff;");
});

</script>
