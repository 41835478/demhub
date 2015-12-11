<div class="modal fade" id="publicationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center">
        <h3 style="display:inline">{{ $publication->title }}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" style="text-align:center">
        <div class="row">
        <table class="table table-hover table-bordered">

          <tbody>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DESCRIPTION</td>
              <td>{{ $publication->description }}</td>
            </tr>
            <!-- <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">AUTHOR</td>
              <td>{{ $publication->author->full_name() }}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DATE</td>
              <td>{{ date_format(new DateTime($publication->publication_date ), 'j F Y') }}</td>
            </tr> -->

            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">PRIVACY</td>
              <td style="text-transform:capitalize">{{ $publication->privacy }}</td>
            </tr>
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">DIVISIONS</td>
              <td>
                <?php
                if ($publication->divisions !=null){
                $publicationsDivisions = array_filter(preg_split("/\|/", $publication->divisions));
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
            </tr>
            @if(! empty($publication->keywords))
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase">keywords</td>
              <td style="text-transform:capitalize">{{ $publication->keywords }}</td>
            </tr>
            @endif
            @if(! empty($publication->publisher))
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px">PUBLISHER</td>
              <td style="text-transform:capitalize">{{ $publication->publisher}}</td>
            </tr>
            @endif
            @if(! empty($publication->pages))
            <tr>
              <td class="col-xs-3 col-sm-2" style="background-color:#ccc;text-align:center;padding-bottom:8px;text-transform:uppercase">pages</td>
              <td style="text-transform:capitalize">{{ $publication->pages }}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
        <div class="row">
          <a class="btn btn-style-alt" style="margin-right:10px;text-transform:uppercase" href="{{ $publication->document->url() }}" download>show</a>
          <a class="btn btn-style-alt" style="margin-right:10px;text-transform:uppercase" href="{{ URL::to('my_publication/' . $publication->id . '/edit') }}">edit</a>
          <a class="btn btn-style-alt" style="text-transform:uppercase" href="{{url('publication_filter')}}">PUBLICATIONS</button>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
