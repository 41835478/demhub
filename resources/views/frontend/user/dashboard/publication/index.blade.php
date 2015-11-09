@extends('frontend.layouts.master')


@section('content')

  <div id="user-settings" class="row">
    <div class="col-md-12" style="padding:0px">
      <div class="col-md-3" style="background: rgba(0,0,0,0.85);padding:0px;">
        @include('frontend.user.dashboard.menu._dashboard_menu')
      </div>

      <div class="col-md-9" style="padding:0px;margin-left:-5%">
        <div class="panel panel-default">
        <a href="{{ URL::to('publication/new') }}">Create a Publication</a>

        @if($publications)
          <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Author</td>
                    <td>Has attached doc?</td>
                    <td>Actions</td>
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

                        <a class="btn btn-small btn-success" href="{{ URL::to('publication/' . $pub->id) }}">Show this Publication</a>

                        <a class="btn btn-small btn-info" href="{{ URL::to('publication/' . $pub->id . '/edit') }}">Edit this Publication</a>

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
  </div>

@endsection
