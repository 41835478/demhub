<nav id="guest-menu" class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			@if (Request::url() === URL::route('home'))

			@else

			@endif
			<a href="{{url('')}}">{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'width:175px;padding-left:30px;padding-top:10px')) !!}</a>
		</li>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@if (Request::url() === url('about'))
				<li class="active">
				@else
				<li>
				@endif
				{!! link_to('about', trans('ABOUT')) !!}</li>

				@if (Request::url() === url('auth/register'))
				<li class="active">
				@else
				<li>
				@endif
        {!! link_to('auth/register', trans('REGISTER')) !!}</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<!-- <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <spanclass="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li>{!! link_to('lang/en', trans('menus.language-picker.langs.en')) !!}</li>
						<li>{!! link_to('lang/es', trans('menus.language-picker.langs.es')) !!}</li>
						<li>{!! link_to('lang/it', trans('menus.language-picker.langs.it')) !!}</li>
						<li>{!! link_to('lang/pt-BR', trans('menus.language-picker.langs.pt-BR')) !!}</li>
                          <li>{!! link_to('lang/ru', trans('menus.language-picker.langs.ru')) !!}</li>
						<li>{!! link_to('lang/sv', trans('menus.language-picker.langs.sv')) !!}</li>
					</ul>
					</li> -->
				@if (Auth::guest())
				@if (Request::url() === url('auth/login'))
				<li class="active" style="padding-right:50px">
				@else
				<li style="padding-right:50px">
				@endif
          {!! link_to('auth/login', trans('LOGIN')) !!}</li>
					<!-- <li>{!! link_to('auth/login', trans('navs.login')) !!}</li>
					<li>{!! link_to('auth/register', trans('navs.register')) !!}</li> -->
				@else
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
						    <li>{!! link_to('dashboard', trans('navs.dashboard')) !!}</li>
							    <li>{!! link_to('auth/password/change', trans('navs.change_password')) !!}</li>
						    @permission('view-backend')
						        <li>{!! link_to_route('backend.dashboard', trans('navs.administration')) !!}</li>
							    @endauth
							<li>{!! link_to('auth/logout', trans('navs.logout')) !!}</li>
						</ul>
					</li>
					@endif
			</ul>
		</div>
	</div>
</nav>

@if( ! empty($nav_divisions))
<div class="row" style="padding-top:52px;">
	<div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">
		@foreach($nav_divisions as $div)

			<a href="{{url('division', array('id' => $div->slug))}}">
				<div id="division_{{$div->id}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$div->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
					<p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$div->name}}</p>
				</div>
			</a>

		@endforeach

	</div>
</div>
<!-- <nav class="navbar navbar-default nav-justified">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#divisions-navbar-collapse-1">
				<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="divisions-navbar-collapse-1">
			<ul class="nav navbar-nav">
				@foreach($nav_divisions as $div)
					<li>{!! link_to('division/'.$div->slug, $div->name) !!}</li>
				@endforeach
			</ul>
		</div>
	</div>
</nav> -->
@endif