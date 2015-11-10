@extends('frontend.layouts.master')

@section('content')

<div id="user-settings" class="row" style="padding-top:50px;padding-left:60px">

		<div class="col-md-2" style="background: rgba(0,0,0,0.85);padding-bottom:50px;">
			@include('frontend.user.dashboard.menu._dashboard_menu')
		</div>



<div class="row">
  <div class="col-md-8" style="padding-right:100px">
<!-- <div class="col-md-10 col-md-offset-1" style="overflow-x:hidden;padding-left:7%"> -->

  @foreach($users as $user)


      <div class="col-xs-12 col-sm-6 col-md-4">
      <div class = "feedsbox">


        <div class ="color-label division_all"></div>
        <div class="inner-feedsbox" style="text-align:center;width:250px">

        <h3>
          {{$user->first_name}} {{$user->last_name}}

        </h3>
        <img class="img-responsive img-circle" style="width:150px;display:inline" src="{{$user->avatar->url('medium')}}"><span style="visibility:hidden">*</span>
        <!-- <span class="label label-default" style="font-size:82%">

        </span> -->





<div style="width:100%; height:40px; bottom:0px; position:absolute;">

            <!-- <button type="button" class="btn btn-default btn-style-alt" aria-label="Left Align" data-toggle="popover"
            data-content="Feed successfully added to your favourite">


    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
  </button> -->

  <!-- <button type="button" class="btn btn-default btn-sm" style="margin-left:5px;">
    <div class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> xxx</div>
  </button> -->



  <a type="button" class="btn btn-default btn-style-alt" href="mailto:{{$user->email}}?Subject=DEMHUB%20Connection" target="_top">
    <div class="glyphicon glyphicon-envelope" aria-hidden="true"> Email</div>
  </a>



      <!-- <a button type="button" class="btn btn-default btn-sm" style="margin-left:5px;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <div class="glyphicon glyphicon-comment" aria-hidden="true"> COMMENT</div>
      </button></a>
      <ul class="dropdown-menu" aria-labelledby="dLabel" style="width:100%; heigth:auto; margin-left:-30px; padding: 15px 15px 15px 15px;">
      <li>Place Holder
      </li>
      <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
      <hr>
      <li>Place Holder
      </li>
      <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
      <hr>
      <li>Place Holder
      </li>
      <p> Lorem ipsum dolor sit amet, consetetur sadipscing elitr </p>
      <hr>

      <div class="form-group">
        <input type="text" class="form-control" placeholder="Comment" style="width:100%; height: 100px;">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>

    </ul> -->

</div>
      </div>
    </div> <!-- the div that closes the box -->
  </div>


  @endforeach

<!-- </div> -->
</div>
</div>

@endsection('content')
