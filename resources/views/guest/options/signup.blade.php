@if(!Auth::check())
<div class="row">
	<div class="col-md-12">
    	<a href="{{url('sign-up')}}">
        	<button type="button" class="btn btn-primary">Sign-Up</button>
        </a>
    </div>
</div>
@endif
