<nav id="guest-menu" class="navbar navbar-default navbar-inverse navbar-fixed-top">
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
					<span id="toggle_sidemenu_l" class="fa fa-bars" style="top: 0; position: absolute; left: -10px;"></span>
				</div>
				<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white-beta.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px;position: absolute;top: 7px;left: 45px;')) !!}</a>
			@else
				<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white-beta.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px;')) !!}</a>
			@endif

		</div>

		<div class="collapse navbar-collapse" id="navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if (Auth::guest())
					<li
						@if (Request::url() === url('about'))
						 class="active"
						@endif
					>{!! link_to('about', trans('ABOUT')) !!}</li>

					<li
						@if (Request::url() === url('auth/register'))
						 class="active"
						@endif
					>{!! link_to('auth/register', trans('JOIN NOW')) !!}</li>
				@endif

			</ul>

			<ul class="nav navbar-nav navbar-right" style="padding-right:180px">

				@if (Auth::guest())
					<li
						@if (Request::url() === url('auth/login'))
							class="active"
						@endif
						>{!! link_to('auth/login', trans('LOGIN')) !!}</li>
				@else

					<li style="padding:0;">
							<a style="padding:5% 0 0 0;">
								@if (isset($navDivisions))
										{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
										{!! Form::text('query_term', (isset($query_term)) ? $query_term : NULL, ['class' => 'form-control', 'placeholder' => 'Search News']) !!}
										{!! Form::close() !!}
								@endif
							</a>
					</li>

					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase">
							<img class="img-responsive img-circle" style="height:25px;width:25px;display:inline;" src="{{Auth::user()->avatar->url('thumb')}}"><span style="visibility:hidden">*</span> {{ Auth::user()->first_name}} <span class="caret"></span>
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

		</div>
	</div>
</nav>
