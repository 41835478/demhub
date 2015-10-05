@if(!Auth::check())
<div class="row">
   	<div class="col-md-12">
    	<a href="{{url('login')}}">
    		<button type="button" class="btn btn-primary">Log-In</button>
        </a>
    </div>
</div>
@endif
