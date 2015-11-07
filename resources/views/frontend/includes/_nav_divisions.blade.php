<nav>
  <div class="division-navbar">

      <div class="row">
        <div class="col-xs-12">

          @foreach($allDivisions as $div)
            <a href="{{url('division', array('id' => $div->slug))}}">
              <div style="" class="col-md-2 divisions-navbar-item division_{{$div->slug}}">
                <h4>{{$div->name}}</h4>
              </div>
            </a>
          @endforeach

        </div>
      </div>

    </div>
</nav>
