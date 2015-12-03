@extends('frontend.layouts.master')

@section('content')
  <a class="btn btn-small btn-success" href="{{ URL::to('my_publications') }}">Show All Publications</a>

  <table class="table table-striped table-bordered">
      <tr>

          <td>{{ $publication->title }}</td>
          <td>{{ $publication->description }}</td>
          <td>{{ $publication->document->url() }}</td>

          <!-- we will also add show, edit, and delete buttons -->
          <td>

              <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
              <!-- we will add this later since its a little more complicated than the other two buttons -->

              <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
              <a class="btn btn-small btn-info" href="{{ URL::to('my_publication/' . $publication->id . '/edit') }}">Edit this Publication</a>

          </td>
      </tr>
  </table>
@endsection
