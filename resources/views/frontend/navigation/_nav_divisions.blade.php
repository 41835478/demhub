<nav>
  <div class="welcome-division">
    {{--  <div id="welcome-division-category" class="row welcome-division-{{$currentDivision->slug}}" style="

                                "> --}}

    <div id="welcome-division-category">


          <div class="row">
          @foreach($navDivisions as $div)
            <a href="{{url('division', array('id' => $div->slug))}}">
              <div class="col-md-2 divisions-page-item division_{{$div->slug}}">
                <h4>{{$div->name}}</h4>
              </div>
            </a>
          @endforeach

        </div>

    </div>

  </div>
</nav>
