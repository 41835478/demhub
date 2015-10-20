<nav>
  <div id="welcome-division">

    <div id="welcome-division-category" class="row" style="background:
                                url('../images/backgrounds/divisions/{{$currentDivision->slug}}.jpg') no-repeat fixed 0% 70%;
                                -webkit-background-size: cover;
                                -moz-background-size: cover;
                                -o-background-size: cover;
                                background-size: cover;
                                overflow: hidden;"
                                >
      <div class="row" style="padding-top:50px;">
        <div id="welcome-division-menu" class="col-xs-12" style="opacity: 0.75;filter: alpha(opacity=75);padding:0px;">

          @foreach($navDivisions as $div)
            <a href="{{url('division', array('id' => $div->slug))}}">
              <div id="division_{{$div->slug}}" style="opacity: 0.75;filter: alpha(opacity=75);background-color: #{{$div->bg_color}};min-height:67px;max-height:67px" class="col-md-2">
                <p style="text-align:center;padding-top:11px;text-transform:uppercase;">{{$div->name}}</p>
              </div>
            </a>
          @endforeach

        </div>
      </div>

      <div class="row">
        <div id="ph-name" class="col-md-4 col-md-offset-8 text-center" style="opacity: 0.75;filter: alpha(opacity=75)">
          <h1 style="background:#{{$currentDivision->bg_color}}">
            {{$currentDivision->name}}
          </h1>
        </div>
      </div>

    </div>

  </div>
</nav>
