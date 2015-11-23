<nav>
  <div class="welcome-division">

    {{--  <div id="welcome-division-category" class="row welcome-division-{{$currentDivision->slug}}" style="

                                "> --}}

    <div id="welcome-division-category" class="welcome-division-{{$currentDivision->slug}}">

    <div id ="welcome-division-bar">
        <div class="row" style="z-index:9999">
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
        <div class="ph-name col-md-8 col-md-offset-4 division_{{$currentDivision->slug}}">
          <h1>
            <font style="visibility:hidden">**</font>{{$currentDivision->name}}
          </h1>
        </div>
      </div>

    </div>

  </div>
</nav>


<script>
$(window).on('scroll', function() {
    var y_scroll_pos = window.pageYOffset;
    var scroll_pos_test = 450;             // set to whatever you want it to be

    if(y_scroll_pos > scroll_pos_test) {
      $('#welcome-division-bar').addClass('fix-division-bar ');
      $('.divisions-page-item').addClass('float-top');
    }
    else {
      $('#welcome-division-bar').removeClass('fix-division-bar ');
    }
});
</script>
