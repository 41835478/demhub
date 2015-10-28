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
