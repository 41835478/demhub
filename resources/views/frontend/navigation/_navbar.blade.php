{{-- added to account for a fixed navigaion height on mobile
	TODO: move all other adjustments for top meu here, i.e. paddings on content divs and body  --}}
<div class="container-fluid" style="height: 75px"></div>
<div class="visible-xs" style="height: 50px;"></div>

<nav id="top-menu" class="navbar navbar-default navbar-inverse navbar-fixed-top" style="min-height: 65px;">

		<div class="navbar-header col-xs-12 row" style="padding: 0;  margin: 0;">
			<?php /*
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
 			*/ ?>

			<div class="col-xs-2 nav-top-adjust">
				<a href="{{url('/')}}" class="">
					{!! HTML::image("/images/logo/logo-min-white.png", "DEMHUB logo", array('class' => 'img-responsive','style' => 'max-width: 140px;min-width: 120px;width: 100%;')) !!}
				</a>
			</div>

			<div class="col-xs-10" style="padding: 0;">
				<div class="" id="navbar-collapse-1">
					<ul class="navbar" style="margin-bottom:-10px">

						<style>
							.nav-search-text,
							.nav-searchbar,
							.nav-search-icon-style{
								border: none;
							}
							.nav-search-text.active,
							.nav-search-icon-style.active,
							.nav-search-text:focus,
							.nav-search-icon-style:focus{
								box-shadow: none;
								background-color: #eee !important;
								color: #ed6b00 !important;
							}
							.nav-searchbar.active,
							.nav-searchbar:focus{
								box-shadow: none;
								background-color: #fff !important;
								color: #ed6b00 !important;
							}
							.animate{
								-webkit-transition: all 0.3s ease;
								-moz-transition: all 0.3s ease;
								-o-transition: all 0.3s ease;
								transition: all 0.3s ease;
							}
							#top-menu .nav-dropdown-image{
								height:30px;
								width:30px;
								display:inline-block;
								vertical-align: middle;
								background-size: cover;
							}
						</style>

						<div class="col-xs-8 hidden-xs">
							@if (Auth::user())
							<li class="" style="padding-top: 15px;">

								{!! Form::open(['url' => url('search'), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
								<div class="form-group" style="padding-left:15%;">
									<div class="input-group searchbar-group" style="width: 100%">
										<i class="fa fa-angle-down" style="position: absolute;left: 15%;top: 10px;color: #aaa;"></i>
										<select class="input-group-addon nav-search-text animate" name="scope"
												style="float: left;width: 20%;padding: 9px;">
											<option value="all">All</option>
											<option value="articles">Articles</option>
											<option value="users">Users</option>
											<option value="publications">Publications</option>
											<option value="resources">Resources</option>
										</select>
										<input name="query_term" class="text-left form-control nav-searchbar animate" value="{{ (isset($query_term)) ? $query_term : '' }}" placeholder="Search DEMHub" style="width: 70%;">
										<button type="submit" class="input-group-addon nav-search-icon-style animate" style="width: 10%;padding: 9.5px">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								{!! Form::close() !!}

							</li>
							@else



							@endif
						</div>

						<div class="col-xs-12 col-sm-4">
							<ul class="navbar-nav navbar-right navbar-style nav-top-adjust" style="padding: 12px 0 0 0;text-align: right; margin: 0 -15px;">

								@if (Auth::guest())

								<li class="
									@if (Request::url() === url('about'))
									active
									@endif" style="display:inline-block; padding-top: 15px">
									<a href="{{url('about')}}">{!! trans('ABOUT') !!}</a>
								</li>

								<li class="
								@if (Request::url() === url('auth/register'))
								active
								@endif"
									style="display:inline-block; padding-top: 15px"><a href="{{url('auth/register')}}">{!! trans('JOIN NOW') !!}</a>
								</li>

								<li class="
								@if (Request::url() === url('auth/login'))
								active
								@endif"
									style="display:inline-block; padding-top:15px">
									{!! link_to('auth/login', trans('LOGIN')) !!}
								</li>

								@else

								{{--
								<li class="
							@if (Request::url() === url('public_journal'))
								active
							@endif">
									<a href="{{url('public_journal')}}" class="" style="">
										<h3 class="glyphicon glyphicon-folder-close" style="margin: -17px auto 0 auto;padding-left:1%;"></h3>
										<p style="font-size:55%">{!! trans('PUBLICATIONS') !!}<p>
									</a>
								</li> --}}

								<li class="text-center
							@if (Request::url() === url('info_resources'))
								active
							@endif" style="display:inline-block;">
									<a href="{{url('info_resources')}}">
										<i class="fa fa-book fa-fw" style="margin: 0 auto;font-size: 2.0em;"></i>
										<p style="font-size:55%;">{!! trans('RESOURCES') !!}<p>
									</a>
								</li>

								<li class="text-center
							@if (strpos(Request::url(), 'forum') == true)
							active
							@endif" style="display:inline-block;">
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
								<script>
									$("#top-menu li a").mouseenter(function() {
										$(this).children(".img-circle").attr("style","background:linear-gradient(rgba(237, 107, 0, 0.5), rgba(237, 107, 0, 0.5)),url({{Auth::user()->avatar->url('thumb')}});background-size:cover;");
									});
									$("#top-menu li a").mouseleave(function() {
										$(this).children(".img-circle").attr("style","background-image:url({{Auth::user()->avatar->url('thumb')}});");
									});
								</script>
								@endif

							</ul>
						</div>
					</ul>
				</div>
			</div>
		</div>


	@if (Auth::user())
	<div class="container-fluid row visible-xs">
		<li class="col-xs-10 col-xs-offset-1" style="margin-top: -20px">
			{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
			<div class="form-group" style="">
				<div class="input-group searchbar-group" style="width: 100%">
					<select class="input-group-addon nav-search-text animate" name="scope"
							style="float: left;width: 20%;padding: 9px;">
						<option value="all">All</option>
						<option value="articles">Articles</option>
						<option value="users">Users</option>
						<option value="publications">Publications</option>
						<option value="resources">Resources</option>
					</select>
					<i class="fa fa-angle-down" style="position: absolute;left: 15%;top: 10px;color: #aaa;"></i>
					<input name="query_term" class="text-left form-control nav-searchbar animate" value="{{ (isset($query_term)) ? $query_term : '' }}" placeholder="Search DEMHub" style="width: 70%;">
					<button type="submit" class="input-group-addon nav-search-icon-style animate" style="width: 10%;padding: 9.5px">
						<i class="fa fa-search"></i>
					</button>
				</div>
			</div>
			{!! Form::close() !!}
		</li>
	</div>
	@endif
	<?php /*@elseif (Request::url() === url('forum/all_threads'))
<div class="row visible-sm">
	<div class="col-xs-12">
		<h1>Hey</h1>
	</div>
</div>
@endif */ ?>
</nav>
<script>
//	$(".nav-searchbar").focus(function() {
//		$(".nav-searchbar").addClass("active");//.attr("style","color: #ed6b00;background-color:#fff;");
//		$(".nav-search-icon-style").addClass("active");//.attr("style","background-color: #fff;color: #ed6b00;");
//		$(".nav-search-text").addClass("active");//.attr("style","background-color: #ededed;color: #ed6b00;");
//	});

	$(document).ready(function(){
		$(".searchbar-group").mouseenter(function() {
			search_focus(true);
		}).mouseleave(function() {
			search_focus(false);
		});

		$(".nav-searchbar, .nav-search-text, .nav-search-icon-style").blur(function(){
			search_focus(false);
		}).focus(function(){
			search_focus(true);
		});

		if(!$(".nav-searchbar").val().trim() == ""){
			search_focus(true);
		}
	});

	function search_focus(give_focus){
		if(give_focus){
			$(".nav-searchbar").addClass("active");//.attr("style","color: #ed6b00;background-color:#fff;");
			$(".nav-search-icon-style").addClass("active");//.attr("style","background-color: #fff;color: #ed6b00;");
			$(".nav-search-text").addClass("active");//.attr("style","background-color: #ededed;color: #ed6b00;");
		} else {
			if($(".nav-searchbar").val().trim() == ""
				&& !$(".nav-searchbar").is(":focus")
				&& !$(".nav-search-icon-style").is(":focus")
				&& !$(".nav-search-text").is(":focus"))
			{
				$(".nav-searchbar").removeClass("active");//.attr("style","background-color:#546f7a;");
				$(".nav-search-icon-style").removeClass("active");//.attr("style","background-color: #546f7a;color: #fff;");
				$(".nav-search-text").removeClass("active");//.attr("style","background-color:#455a63;color:#fff;");
			}

		}
	}



</script>
