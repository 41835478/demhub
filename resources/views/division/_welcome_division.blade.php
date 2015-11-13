<nav>
  <div class="welcome-division">

    <div id="welcome-division-category" class="row welcome-division-{{$currentDivision->slug}}" style="background:
                                url('../images/backgrounds/divisions/{{$currentDivision->slug}}.jpg') no-repeat fixed 0% 70%;
                                -webkit-background-size: cover;
                                -moz-background-size: cover;
                                -o-background-size: cover;
                                background-size: cover;
                                overflow: hidden;">

      <div class="row">
        <div class="col-xs-12">

          @foreach($navDivisions as $div)
            <a href="{{url('division', array('id' => $div->slug))}}">
              <div class="col-md-2 divisions-page-item division_{{$div->slug}}">
                <h4>{{$div->name}}</h4>
              </div>
            </a>
          @endforeach

        </div>
      </div>

      <div class="row">
        <div class="ph-name col-md-8 col-md-offset-8 division_{{$currentDivision->slug}}">
          <h1>
            <font style="visibility:hidden">**</font>{{$currentDivision->name}}
          </h1>
        </div>
      </div>

    </div>

  </div>
</nav>
