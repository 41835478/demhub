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

        @if($publications)

          <table class="table table-hover table-bordered">
            <thead style="background-color:#ccc">
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
              @for ($i=(sizeof($publications)-1);$i>-1;$i--)

                <tr>
                    <td><label>
                      <input type="checkbox" class="radio-inline" id="{{ $publications[$i]->title }}" name="{{ $publications[$i]->title }}" style=""></label>
                    </td>
                    <td><a href="{{ url('publication_filter') }}">{{ $publications[$i]->title }}</a></td>
                    <td>{{ $publications[$i]->author->full_name() }}</td>
                    <td>{{ date_format(new DateTime($publications[$i]->publication_date ), 'j F Y') }}</td>

                    <td><a class="greytone" href="{{ URL::to('my_publication/' . $publications[$i]->id . '/edit') }}"
                      data-toggle="tooltip" data-placement="top" title="EDIT">
                      <h3 class="glyphicon glyphicon-edit" style="margin:0px"></h3></a>
                    <a class="greytone" href="{{ $publications[$i]->document->url() }}" download style="padding-left:5px"
                      data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                      <h3 class="glyphicon glyphicon-save" style="margin:0px"></h3></a>
                    <a class="greytone" href="{{ URL::to('my_publication/' . $publications[$i]->id) }}" style="padding-left:5px"
                      data-toggle="tooltip" data-placement="top" title="SHOW DETAILS">
                      <h3 class="glyphicon glyphicon-info-sign" style="margin:0px"></h3></a></td>

                    <td>
                      <?php
                      if ($publications[$i]->divisions !=null){
                      $publicationsDivisions = array_filter(preg_split("/\|/", $publications[$i]->divisions));
                      }
                      ?>
                      @if ($publicationsDivisions)
                        @foreach ($publicationsDivisions as $publicationsDivision)

                        <a href="{{url('/division/'.$publicationsDivision)}}" >
                        <img style="width:18px;height:18px;margin-top:-10px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive division_{{ $publicationsDivision }}">
                      </a>


                        @endforeach
                      @endif
        						</td>
                    <td></td>

                </tr>
              @endfor
            </tbody>
          </table>
        @else
          <p>No publications</p>
        @endif

      </div>
    </div>
  </section>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
</script>
@endsection
