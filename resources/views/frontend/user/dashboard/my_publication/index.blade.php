@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" class="" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn row center-block mt10 " style="">
      <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="">
        <a type="button" class="btn btn-style-alt" href="{{ route('publications') }}" style="margin-left:1px">
          <span class="glyphicon glyphicon-folder-close"></span>
          <span style="visibility:hidden">*</span> ALL PUBLICATIONS
        </a>

        <div class="col-md-offset-7 col-sm-offset-6" style="display:inline">
          <a type="button" class="btn btn-style-alt" href="{{ URL::to('my_publication/new') }}">NEW</a>
        </div>

        <table class="table table-hover table-bordered">

          <thead style="background-color:#ccc">
              <tr>
                <td><a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="text-transform: uppercase;padding-right:5px;padding-left:5px">
                  <span class="caret" style="color:#333"></span></a>
                  <ul class="dropdown-menu navbar-inverse" role="menu">
                    <li><a class="text-alt" href="javascript:caretSet('del')">DELETE</a></li>
                  </ul>
                </td>
                <td>TITLE</td>
                <td>UPLOADER</td>
                <td>DATE</td>
                <td>ACTIONS</td>
                <td>DIVISIONS</td>
                <td>VIEWS</td>
              </tr>
          </thead>

          <tbody style="background-color:#fff;">
            {!! Form::open(['route' => ['caret_publication_action', $caret], 'files' => true, 'class' => 'form-horizontal',
            'method' => 'POST', 'data-toggle'=>'validator', 'data-delay'=>'1100', 'role' => 'form', 'id' => 'caretForm']) !!}
              @if(!empty($publications))

                @foreach ($publications as $publication)

                  <tr>
                    <td><label>
                      <input type="checkbox" class="radio-inline pub_checkbox" id="{{ $publication->id }}" style="">
                    </label></td>

                    <td><a href="{{ URL::to('publication/' . $publication->id . '/view') }}">{{ $publication->name }}</a></td>
                    <td>{{ $publication->uploader->full_name() }}</td>
                    <td>{{ $publication->humanReadablePublishDate() }}</td>

                    <td>
                      <a class="" href="{{ URL::to('my_publication/' . $publication->id . '/edit') }}"
                        data-toggle="tooltip" data-placement="top" title="EDIT">
                        <h2 class="glyphicon glyphicon-edit" style="margin:0px;color:#000"></h2>
                      </a>

                      @if (isset($publication) && $publication->mainMedia())
                        <a class="" href="{{ $publication->mainMediaUrl() }}" style="padding-left:5px"
                          data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                          <h3 class="icon file_download" style="margin:-2px;"></h3>
                        </a>
                      @endif

                      <a class="" href="" style="padding-left:5px"
                        data-toggle="modal" data-target="#publicationModal{{ $publication->id }}" data-toggle="tooltip" data-placement="top" title="SHOW DETAILS">
                        <h3 class="icon assignment" style="margin:-2px"></h3>
                      </a>
                    </td>

                    <td>
                      <?php $publicationsDivisions = $publication->divisions(); ?>
                      @if (!empty($publicationsDivisions))
                        @foreach ($publicationsDivisions as $divSlug => $divName)
                          <a href="{{url('/division/'.$divSlug)}}">
                            <img title="{{ $divName }}" class="img-circle img-responsive division_{{ $divSlug }}" style="width:18px;height:18px;margin-top:-3px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png">
                          </a>
                        @endforeach
                      @endif
                    </td>

                    <td>{{ $publication->views() }}</td>

                  </tr>

                @endforeach

              @else

                <tr>
                  <td>
                    <p>No publications</p>
                  </td>
                </tr>

              @endif
              {!! Form::submit('SAVE', ['class' => 'btn btn-style-alt', 'id' => 'saveButton', 'style' => 'visibility:hidden']) !!}
            {!! Form::close() !!}
          </tbody>

        </table>

      </div>
    </div>
  </section>


@endsection

@section('modal')
  @if(!empty($publications))
    @foreach ($publications as $publication)
      @include('modals._publication_preview', compact('publication'))
    @endforeach
  @endif
@endsection
