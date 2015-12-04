@extends('frontend.layouts.master')


@section('content')
@include('frontend.user.dashboard.style')
@include('frontend.navigation._user-dashboard-sidebar')
<section id="content_wrapper" style="margin-top: 60px;">

  <!-- Begin: Content -->
  <div id="content" class="animated fadeIn" style="padding-bottom: 0;">
    <div class="row center-block mt10" style="">
        <div class="panel panel-default" style="padding-bottom:15%">
          <div class="col-sm-offset-9">
            <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">CREATE</a>
          </div>

        @if($publications)
          <table class="table table-striped table-bordered" style="background-color:#ccc">
            <thead>
                <tr>
                    <td><span class="caret"></span></td>
                    <td>TITLE</td>
                    <td>AUTHOR</td>
                    <td>DATE</td>
                    <td>ACTIONS</td>
                    <td>DIVISIONS</td>
                    <td>VIEWS</td>
                </tr>
            </thead>
            <tbody>
              @foreach ($publications as $pub)
                <tr>
                    <td><label>
                      <input type="checkbox" class="radio-inline" id="{{ $pub->title }}" name="{{ $pub->title }}" style=""></label>
                    </td>
                    <td><a href="{{ URL::to('my_publication/' . $pub->id) }}">{{ $pub->title }}</a></td>
                    <td>{{ $pub->author->full_name() }}</td>
                    <td>{{ date_format(new DateTime($pub->updated_at ), 'j F Y | g:i a') }}</td>

                    <td><a class="greytone" href="{{ URL::to('my_publication/' . $pub->id . '/edit') }}"><h3 class="glyphicon glyphicon-edit" style="margin:0px"></h3></a>
                    <a class="greytone" href="{{ $pub->document->url() }}" download style="padding-left:5px"><h3 class="glyphicon glyphicon-save" style="margin:0px"></h3></a>
                    <a  class="greytone" href="{{ URL::to('my_publication/' . $pub->id) }}" style="padding-left:5px"><h3 class="glyphicon glyphicon-info-sign" style="margin:0px"></h3></a></td>

                    <td>
                      <?php
                      if ($pub->divisions !=null){
                      $publicationDivisions = array_filter(preg_split("/\|/", $pub->divisions));
                      }
                      ?>
                      @if ($publicationDivisions)
                        @foreach ($publicationDivisions as $publicationDivision)

                        <a href="{{url('/division/'.$publicationDivision)}}" >
                        <img style="width:18px;height:18px;margin-top:-10px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive division_{{ $publicationDivision }}">
                      </a>


                        @endforeach
                      @endif
        						</td>
                    <td></td>

                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p>No publications</p>
        @endif
      </div>
      </div>
    </div>
  </section>

@endsection
