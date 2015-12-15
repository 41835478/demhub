@extends('frontend.layouts.master')


@section('content')
@include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar')
<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="">
    <div class="row center-block mt10" style="">

          <div class="col-sm-offset-9">
            <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
          </div>

          <table class="table table-hover table-bordered">
            <thead style="background-color:#ccc">

                <tr>
                    <td><a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase;padding-right:5px;padding-left:5px">
                      <span class="caret" style="color:#333"></span></a>
                      <ul class="dropdown-menu navbar-inverse" role="menu">
          						  <li><a href="javascript:caretSet('del')">DELETE</a></li>
                      </ul>
                    </td>
                    <td>TITLE</td>
                    <td>AUTHOR</td>
                    <td>DATE</td>
                    <td>ACTIONS</td>
                    <td>DIVISIONS</td>
                    <td>VIEWS</td>
                </tr>
            </thead>
            <tbody>

                {!! Form::open(['route' => ['caret_publication_action', $caret], 'files' => true, 'class' => 'form-horizontal',
                'method' => 'POST', 'data-toggle'=>'validator', 'data-delay'=>'1100', 'role' => 'form', 'id' => 'caretForm']) !!}
              @if(! empty($publications))
              @foreach ($publications as $publication)

                <tr>
                    <td><label>

                      <input type="checkbox" class="radio-inline pub_checkbox" id="{{ $publication->id }}" style=""></label>
                    </td>
                    <td><a href="{{ URL::to('my_publication/' . $publication->id . '/view') }}">{{ $publication->title }}</a></td>
                    <td>{{ $publication->author->full_name() }}</td>
                    <td>{{ date_format(new DateTime($publication->publication_date ), 'j F Y') }}</td>

                    <td><a class="greytone" href="{{ URL::to('my_publication/' . $publication->id . '/edit') }}"
                      data-toggle="tooltip" data-placement="top" title="EDIT">
                      <h3 class="glyphicon glyphicon-edit" style="margin:0px"></h3></a>
                    <a class="greytone" href="{{ $publication->document->url() }}" download style="padding-left:5px"
                      data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                      <h3 class="glyphicon glyphicon-save" style="margin:0px"></h3></a>
                    <a class="greytone" href="{{ URL::to('my_publication/' . $publication->id) }}" style="padding-left:5px"
                      data-toggle="tooltip" data-placement="top" title="SHOW DETAILS">
                      <h3 class="glyphicon glyphicon-info-sign" style="margin:0px"></h3></a></td>

                    <td>
                      <?php
                      if ($publication->divisions !=null){
                      $publicationsDivisions = array_filter(preg_split("/\|/", $publication->divisions));
                      }
                      ?>
                      @if (! empty($publicationsDivisions))
                        @foreach ($publicationsDivisions as $publicationsDivision)

                        <a href="{{url('/division/'.$publicationsDivision)}}" >
                        <img style="width:18px;height:18px;margin-top:-10px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive division_{{ $publicationsDivision }}">
                      </a>


                        @endforeach
                      @endif
        						</td>
                    <td>{{ $publication->views }}</td>

                </tr>
              @endforeach
              {!! Form::submit('SAVE', ['class' => 'btn btn-style-alt', 'id' => 'saveButton', 'style' => 'visibility:hidden']) !!}
              {!! Form::close() !!}
              @else
              <tr>
                <td>
                  <p>No publications</p>
                </td>
              </tr>
              @endif

            </tbody>
          </table>

      </div>
    </div>
  </section>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
var caret="|";

$(".pub_checkbox").click(function (){
  if(caret.indexOf(this.id)== -1){
    caret=caret+this.id+"|";
  }
  else if (caret.indexOf(this.id)!= -1){
    var pos=caret.indexOf(this.id);
    caret=caret.substring(0, (pos-1))+caret.substring((pos+1));
  }
});

function caretSet (action){

  var actionLink=$("#caretForm").attr("action");
  actionArray=actionLink.split(000);
  $("#caretForm").attr("action", actionArray[0]+action+"-"+caret);
  $('#saveButton').click();
}
</script>
@endsection
