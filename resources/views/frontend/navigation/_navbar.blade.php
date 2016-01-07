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

			@if(Request::url() === url('dashboard'))
				<div class="navbar-branding">
					<span id="toggle_sidemenu_l" class="fa fa-bars" style="position: absolute; left: -10px;"></span>
				</div>
				<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive nav-top-adjust','style' => 'width:175px;padding-left:30px;position: absolute;top: 7px;left: 45px;')) !!}</a>
			@else
				<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive nav-top-adjust','style' => 'width:175px;padding-left:30px')) !!}</a>
			@endif

		</div>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="navbar col-md-offset-2 col-sm-offset-2" style="">



							@if(isset($searchBar))
							<li class="col-md-7 col-sm-6 nav-top-adjust" style="">
								<div class="input-group">
									{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
										{!! Form::text('query_term', (isset($query_term)) ? $query_term : NULL, ['class' => 'form-control nav-searchbar', 'placeholder' => 'Search','style' => '']) !!}
									{!! Form::close() !!}
								</div>
							@elseif (Auth::user())
							<li class="col-md-7 col-sm-6 nav-top-adjust" style="">

								{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
								<div class="form-group">
									<div class="input-group">
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


			<ul class="navbar-nav navbar-right navbar-style nav-top-adjust" style="display:inline;">

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
					<h3 class="glyphicon glyphicon-book" style="margin: 0 auto;padding-left:13px;"></h3>
					<p style="font-size:55%">{!! trans('RESOURCES') !!}<p>
				</a>


				</li>
				<li
				@if (Request::url() === url('forum/all_threads'))
				 class="active"
				@endif
				><a href="{{url('forum/all_threads')}}">
					<i class="fa fa-comments fa-2x" style="margin: 0 auto;padding-left:13px;"></i>
					<p style="font-size:55%">{!! trans('DISCUSSIONS') !!}<p>
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

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase">
							<img class="img-responsive img-circle seventy-transparent" style="height:25px;width:25px;display:inline;" src="{{Auth::user()->avatar->url('thumb')}}">

							<p style="font-size:55%">{{ Auth::user()->first_name}}<span class="caret"></span></p>

						</a>

						<ul class="dropdown-menu navbar-inverse" role="menu">
						  <li>{!! link_to('dashboard', 'USER DASHBOARD') !!}</li>
						  @permission('view-backend')
						    <li>{!! link_to_route('backend.dashboard', trans('navs.administration')) !!}</li>
						  @endauth
							<li class="divider"></li>
							<li>{!! link_to('auth/logout', trans('navs.logout')) !!}</li>
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
    $(this).siblings(".nav-search-icon-style").attr("style","background-color: #fff;color: #ed6b00;");
		$(this).siblings(".nav-search-text").attr("style","background-color: #ededed;color: #ed6b00;");
});

$("input[type=text]").mouseenter(function() {
    $(this).siblings(".nav-search-icon-style").attr("style","background-color: #fff;color: #ed6b00;");
		$(this).siblings(".nav-search-text").attr("style","background-color: #ededed;color: #ed6b00;");
});
$("#top-menu").mouseleave(function() {
    $("input[type=text]").siblings(".nav-search-icon-style").attr("style","background-color: #546f7a;color: #fff;");
		$("input[type=text]").siblings(".nav-search-text").attr("style","background-color:#455a63;color:#fff;");
});

</script>
