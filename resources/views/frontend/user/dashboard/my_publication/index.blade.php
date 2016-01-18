@extends('frontend.layouts.master')

@section('content')
  <section id="content_wrapper" class="col-md-10 col-md-offset-1" style="margin-top: 60px;">

    <!-- Begin: Content -->
    <div id="content" class="animated fadeIn" style="">
      <div class="row center-block mt10" style="">
        <a type="button" class="btn btn-style-alt" href="{{ route('publications') }}" style="margin-left:1px">
          <span class="glyphicon glyphicon-folder-close"></span>
          <span style="visibility:hidden">*</span> ALL PUBLICATIONS
        </a>

        <div class="col-sm-offset-7" style="display:inline">
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

          <tbody>
            {!! Form::open(['route' => ['caret_publication_action', $caret], 'files' => true, 'class' => 'form-horizontal',
            'method' => 'POST', 'data-toggle'=>'validator', 'data-delay'=>'1100', 'role' => 'form', 'id' => 'caretForm']) !!}
              @if(!empty($publications))
              <script type="text/javascript">
                var demos = {};

                $(document).on("click", "a[data-bb]", function(e) {
                    e.preventDefault();
                    var type = $(this).data("bb");

                    if (typeof demos[type] === 'function') {
                        demos[type]();
                    }
                });
              </script>
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
                        <a class="" href="{{ $publication->mainMediaUrl() }}" download style="padding-left:5px"
                          data-toggle="tooltip" data-placement="top" title="DOWNLOAD">
                          <h3 class="icon file_download" style="margin:-2px;"></h3>
                        </a>
                      @endif

                      <a class="" data-bb="publication{{$publication->id}}" href="#" style="padding-left:5px"
                        data-toggle="tooltip" data-placement="top" title="SHOW DETAILS">
                        <h3 class="icon assignment" style="margin:-2px"></h3>
                      </a>
                    </td>

                    <td>
                      <?php $publicationsDivisions = $publication->divisions(); ?>
                      @if (! empty($publicationsDivisions))
                        @foreach ($publicationsDivisions as $publicationsDivision)
                          <a href="">
                            <img style="width:18px;height:18px;margin-top:-10px;display:inline" src="/images/backgrounds/patterns/alpha_layer.png" class="img-circle img-responsive division_{{ $publicationsDivision }}">
                          </a>
                        @endforeach
                      @endif
                    </td>

                    <td>{{ $publication->views() }}</td>

                  </tr>

                  <script type="text/javascript">
                    demos.publication{{$publication->id}} = function() {
                      bootbox.dialog({
                        message: "I am a custom dialog",
                        title: "{{$publication->name}}",
                        buttons: {
                          success: {
                            label: "Success!",
                            className: "btn-success",
                            callback: function() {
                              Example.show("great success");
                            }
                          },
                          danger: {
                            label: "Danger!",
                            className: "btn-danger",
                            callback: function() {
                              Example.show("uh oh, look out!");
                            }
                          },
                          main: {
                            label: "Click ME!",
                            className: "btn-primary",
                            callback: function() {
                              Example.show("Primary button");
                            }
                          }
                        }
                      });
                    }
                  </script>

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

@section('before-scripts-end')
  {!! HTML::script("js/bootbox/bootbox.min.js") !!}
@endsection
