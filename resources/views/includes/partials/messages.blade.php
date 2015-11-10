@if ($errors->any() || Session::get('flash_success') || Session::get('flash_danger')|| Session::get('flash_info')|| Session::get('flash_message'))
  @if ($errors->any())
      <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
              {!! $error !!}
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
  @elseif (Session::get('flash_success'))
      <div class="alert alert-success">
          @if(is_array(json_decode(Session::get('flash_success'),true)))
              {!! implode('', Session::get('flash_success')->all(':message<br/>')) !!}
          @else
              {!! Session::get('flash_success') !!}
          @endif
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
  @elseif (Session::get('flash_warning'))
      <div class="alert alert-warning" >
          @if(is_array(json_decode(Session::get('flash_warning'),true)))
              {!! implode('', Session::get('flash_warning')->all(':message<br/>')) !!}
          @else
              {!! Session::get('flash_warning') !!}
          @endif
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
  @elseif (Session::get('flash_info'))
      <div class="alert alert-info" >
          @if(is_array(json_decode(Session::get('flash_info'),true)))
              {!! implode('', Session::get('flash_info')->all(':message<br/>')) !!}
          @else
              {!! Session::get('flash_info') !!}
          @endif
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
  @elseif (Session::get('flash_danger'))
      <div class="alert alert-danger" >
          @if(is_array(json_decode(Session::get('flash_danger'),true)))
              {!! implode('', Session::get('flash_danger')->all(':message<br/>')) !!}
          @else
              {!! Session::get('flash_danger') !!}
          @endif
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
  @elseif (Session::get('flash_message'))
      <div class="alert alert-info" >
          @if(is_array(json_decode(Session::get('flash_message'),true)))
              {!! implode('', Session::get('flash_message')->all(':message<br/>')) !!}
          @else
              {!! Session::get('flash_message') !!}
          @endif
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

  @endif
@endif
