@extends('frontend.layouts.master')

@section('content')
  <a href="{{ URL::to('publication/new') }}">Create a Publication</a>

  @if($publications)
    <table class="table table-striped table-bordered">
      <thead>
          <tr>
              <td>Title</td>
              <td>Description</td>
              <td>Has attached doc?</td>
              <td>Actions</td>
          </tr>
      </thead>
      <tbody>
        @foreach ($publications as $pub)
          <tr>
              <td>{{ $pub->title }}</td>
              <td>{{ $pub->description }}</td>
              <td>{{ $pub->document->url() }}</td>

              <!-- we will also add show, edit, and delete buttons -->
              <td>

                  <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                  <!-- we will add this later since its a little more complicated than the other two buttons -->

                  <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                  <a class="btn btn-small btn-success" href="{{ URL::to('publication/' . $pub->id) }}">Show this Publication</a>

                  <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                  <a class="btn btn-small btn-info" href="{{ URL::to('publication/' . $pub->id . '/edit') }}">Edit this Publication</a>

              </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>No publications</p>
  @endif
@endsection
