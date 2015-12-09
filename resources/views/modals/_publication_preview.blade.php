<div class="modal fade" id="publicationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <table class="table table-striped table-bordered" style="background-color:#ccc">
          <thead>
              <tr>
                  <td>{{ $publication->title }}</td>
              </tr>
          </thead>
          <tbody>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DESCRIPTION</td>
              <td>{{ $publication->description }}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DATE</td>
              <td>{{ $publication->document_content_type }}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">PRIVACY</td>
              <td>{{ $publication->privacy }}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DIVISIONS</td>
              <td>{{ $publication->divisions}}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">PUBLISHER</td>
              <td>{{ $publication->publisher}}</td>
            </tr>
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

          </tbody>
        </table>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
