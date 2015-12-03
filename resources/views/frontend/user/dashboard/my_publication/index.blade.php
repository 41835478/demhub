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
          <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>TITLE</td>
                    <td>AUTHOR</td>
                    <td>DATE</td>
                    <td>ACTIONS</td>
                    <td>DIVISIONS</td>
                    <td>KEYWORDS</td>
                </tr>
            </thead>
            <tbody>
              @foreach ($publications as $pub)
                <tr>
                    <td>{{ $pub->title }}</td>
                    <td>{{ $pub->description }}</td>
                    <td>{{ $pub->author->full_name() }}</td>
                    <td><a href="{{ $pub->document->url() }}" download>Download</a></td>

                    <td>

                        <!-- TODO - ADD delete -->
                        <!-- we will add this later since its a little more complicated than the other two buttons -->

                        <a class="btn btn-small btn-success" href="{{ URL::to('my_publication/' . $pub->id) }}">Show this Publication</a>

                        <a class="btn btn-small btn-info" href="{{ URL::to('my_publication/' . $pub->id . '/edit') }}">Edit this Publication</a>

                    </td>
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
