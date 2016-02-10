{{-- added to account for a fixed navigaion height on mobile
	TODO: move all other adjustments for top meu here, i.e. paddings on content divs and body  --}}
<div class="container-fluid" style="height: 70px"></div>
@if (Auth::user())
	{{-- <div class="visible-xs" style="height: 50px;"></div> --}}
	<div class="visible-xs" style="height: 43px;"></div>
@endif

<nav id="top-menu" class="navbar navbar-default navbar-inverse navbar-fixed-top" style="min-height: 70px;">

	<div class="navbar-header col-xs-12 row" style="padding: 0;  margin: 0;">

		<div class="col-xs-2 nav-top-adjust">
			<a href="{{url('/')}}" class="">
				{!! HTML::image(
					"/images/logo/logo-min-white.png", "DEMHUB logo",
					array('class' => 'img-responsive','style' => 'max-width: 140px;min-width: 120px;width: 100%;')
				) !!}
			</a>
		</div>

		<div class="col-xs-10" style="padding: 0;">
			<div class="" id="navbar-collapse-1">
				<ul class="navbar" style="margin-bottom:-10px">

					{{-- NOTE : Desktop version of search bar --}}
					<div class="col-xs-8 hidden-xs">
						@if (Auth::user())
							<li class="" style="padding-top: 15px; padding-left:10%;">
								@include('frontend.navigation.__search_bar')
							</li>
						@endif
					</div>

					<div class="col-xs-12 col-sm-4">
						<ul class="navbar-nav navbar-right navbar-style nav-top-adjust" style="padding: 12px 0 0 0; text-align: right; margin: 0 -15px;">

							@if (Auth::guest())
								<li class="{{Request::url() === url('about') ? 'active' : ''}}" style="display: inline-block; padding-top: 15px">
									<a href="{{url('about')}}">{!! trans('ABOUT') !!}</a>
								</li>

								<li class="{{Request::url() === url('auth/register') ? 'active' : ''}}" style="display:inline-block; padding-top: 15px">
									<a href="{{url('auth/register')}}">{!! trans('JOIN NOW') !!}</a>
								</li>

								<li class="{{Request::url() === url('auth/login') ? 'active' : ''}}" style="display:inline-block; padding-top:15px">
									{!! link_to('auth/login', trans('LOGIN')) !!}
								</li>
							@else
								{{-- <li class="{{Request::url() === url('public_journal') ? 'active' : ''}}">
									<a href="{{url('public_journal')}}" class="" style="">
										<h3 class="glyphicon glyphicon-folder-close" style="margin: -17px auto 0 auto;padding-left:1%;"></h3>
										<p style="font-size:55%">{!! trans('PUBLICATIONS') !!}<p>
									</a>
								</li> --}}

								<li class="text-center {{Request::url() === route('info_resources') ? 'active' : ''}}" style="display:inline-block;">
									<a href="{{route('info_resources')}}">
										<i class="fa fa-book fa-fw" style="margin: 0 auto;font-size: 2.0em;"></i>
										<p style="font-size:55%;">{!! trans('RESOURCES') !!}<p>
									</a>
								</li>

								<li class="text-center {{strpos(Request::url(), 'forum') == true ? 'active' : ''}}" style="display:inline-block;">
									<a href="{{url('forum/all_threads')}}">
										<i class="fa fa-comments fa-fw" style="margin: -2px auto 2px auto;font-size: 2.2em"></i>
										<p style="font-size:55%;margin-top:-2px">{!! trans('DISCUSSIONS') !!}<p>
									</a>
								</li>

								<li class="dropdown" style="display:inline-block;">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase;">
										<div class="img-circle nav-dropdown-image" style="background-image:url({{Auth::user()->avatar->url('thumb')}});"></div>
										<i class="fa fa-caret-down"></i>
										<p style="font-size:55%;text-align:center;">{{ Auth::user()->first_name}}</p>
									</a>

									<ul class="dropdown-menu navbar-inverse user-dropdown" role="menu" style="position: absolute; margin: -10px 10px 10px -140px;">
										@include('frontend.navigation._user-dashboard-sidebar')
									</ul>
								</li>
							@endif

						</ul>
					</div>

				</ul>
			</div>
		</div>

	</div>

	{{-- NOTE : Mobile version of search bar --}}
	@if (Auth::user())
		<div class="container-fluid row visible-xs list-unstyled">
			<li class="col-xs-10 col-xs-offset-1">
				@include('frontend.navigation.__search_bar')
			</li>
		</div>
	@endif

</nav>
