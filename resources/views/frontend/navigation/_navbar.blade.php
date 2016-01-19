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

		<div class="col-xs-10" style="padding: 0;">
			<div class="collapse navbar-collapse" id="navbar-collapse-1">
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
					</style>

					@if (Auth::user())
					<li class="col-xs-8 nav-top-adjust" style="">

						{!! Form::open(['url' => Request::path(), 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'GET']) !!}
						<div class="form-group" style="padding-left:15%;">
							<div class="input-group searchbar-group" style="width: 100%">
								<select class="input-group-addon nav-search-text animate" name="scope" style="float: left;width: 20%;padding: 9px;">
									<option value="all">All</option>
									<option value="articles">Articles</option>
									<option value="users">Users</option>
									<option value="publications">Publications</option>
									<option value="resources">Resources</option>
								</select>
								<input name="query_term" class="form-control nav-searchbar animate" value="{{ (isset($query_term)) ? $query_term : '' }}" placeholder="Search DEMHub" style="width: 70%;">
								<button type="submit" class="input-group-addon nav-search-icon-style animate" style="width: 10%;padding: 9.5px">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
						{!! Form::close() !!}

					</li>
					@else
					<li class=
						@if (Request::url() === url('about'))
					"active col-md-1 col-sm-1 nav-middle"
					@endif
					"col-md-1 col-sm-1 nav-middle"><a href="{{url('about')}}">{!! trans('ABOUT') !!}</a>
					</li>

					<li class=
						@if (Request::url() === url('auth/register'))
					"active nav-middle"
					@endif
					"col-md-2 col-sm-2 nav-middle"><a href="{{url('auth/register')}}">{!! trans('JOIN NOW') !!}</a>
					</li>
					@endif
					<div class="col-xs-4">
						<ul class="navbar-nav navbar-right navbar-style nav-top-adjust" style="display:inline;margin-top:-10px">

							{{--
							<li class="
							@if (Request::url() === url('public_journal'))
								active
							@endif">
								<a href="{{url('public_journal')}}" class="" style="">
									<h3 class="glyphicon glyphicon-folder-close" style="margin: 0 auto;padding-left:13px;margin-top:-17px;"></h3>
									<p style="font-size:55%">{!! trans('PUBLICATIONS') !!}<p>
								</a>
							</li> --}}

							<li class="text-center
							@if (Request::url() === url('resource_filter'))
								active
							@endif">
								<a href="{{url('resource_filter')}}">
									<i class="fa fa-book fa-fw" style="margin: 0 auto;font-size: 2.5em;"></i>
									<p style="font-size:55%;">{!! trans('RESOURCES') !!}<p>
								</a>
							</li>

							<li class="text-center
							@if (strpos(Request::url(), 'forum') == true)
							active
							@endif" style="padding-left: 15px;">
								<a href="{{url('forum/all_threads')}}">
									<i class="fa fa-comments fa-fw" style="margin: 0 auto 2px auto;font-size: 2.5em"></i>
									<p style="font-size:55%;margin-top:-2px">{!! trans('DISCUSSIONS') !!}<p>
								</a>

							</li>

							@if (Auth::guest())
							<li class="
								@if (Request::url() === url('auth/login'))
								active
								@endif"
								style="padding-top:15px">
								{!! link_to('auth/login', trans('LOGIN')) !!}
							</li>

							@else

							<li class="dropdown" style="padding: 0 0 0 15px;">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase;">
									<img class="img-circle" style="height:35px;width:35px;display:inline;background:url({{Auth::user()->avatar->url('thumb')}});">
									<i class="fa fa-caret-down"></i>
									<p style="font-size:55%;text-align:center;">{{ Auth::user()->first_name}}</p>
								</a>

								<ul class="dropdown-menu navbar-inverse user-dropdown" role="menu">
									@include('frontend.navigation._user-dashboard-sidebar')
								</ul>
							</li>
							<script>
								$("#top-menu li a").mouseenter(function() {
									$(this).children("img").attr("style","background:linear-gradient(rgba(237, 107, 0, 0.5), rgba(237, 107, 0, 0.5)),url({{Auth::user()->avatar->url('thumb')}});height:35px;width:35px;display:inline;");
								});
								$("#top-menu li a").mouseleave(function() {
									$(this).children("img").attr("style","height:35px;width:35px;display:inline;background:url({{Auth::user()->avatar->url('thumb')}});");
								});
							</script>
							@endif

						</ul>
					</div>
				</ul>
			</div>
		</div>
	</div>
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
		})
			.mouseleave(function() {
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

	function search_focus(give){
		if(give){
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
