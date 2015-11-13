<nav>
  <div class="welcome-division">

    {{--  <div id="welcome-division-category" class="row welcome-division-{{$currentDivision->slug}}" style="

                                "> --}}

    <div id="welcome-division-category" class="welcome-division-{{$currentDivision->slug}}">

      <div class="row">


          @foreach($navDivisions as $div)
            <a href="{{url('division', array('id' => $div->slug))}}">
              <div class="col-md-2 divisions-page-item division_{{$div->slug}}">
                <h4>{{$div->name}}</h4>
              </div>
            </a>
          @endforeach


      </div>

      <div class="row">
        <div class="ph-name col-md-8 col-md-offset-4 division_{{$currentDivision->slug}}">
          <h1>
            <font style="visibility:hidden">**</font>{{$currentDivision->name}}
          </h1>
        </div>
      </div>

    </div>

  </div>
  </div>
</nav>
