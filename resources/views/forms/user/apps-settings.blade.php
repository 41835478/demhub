<form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{$action}}">

  <!--App details-->
  <div class="col-md-4">
    <h3>Details</h3>
  </div>
  <div class="col-md-8">
    <div class="form-group has-success has-feedback">
        <label for="app_name">App name</label>
        <br>
      <input class="form-control input-lg" name="app_name" value="{{$userapp->app_name}}" aria-describedby="inputSuccess2Status"/>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
    <div class="form-group has-success has-feedback">
        <label for="app_description">App Description</label>
        <br>
        <textarea class="form-control" rows="3" name="app_description" aria-describedby="inputSuccess2Status">{{$userapp->app_desc}}</textarea>
        <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
        <span id="inputSuccess2Status" class="sr-only">(success)</span>
    </div>
    <div class="form-group has-success has-feedback">

        @if ($userapp->app_public)
            <label>
                <input type="checkbox" id="checkboxSuccess" name="public" value="public" checked>
                Public
            </label>
            <br>
            <kbd>{{secure_url('app/'.$userapp->user_name.'/'.$userapp->app_url, $parameters = array())}}</kbd>
        @else
            <label>
                <input type="checkbox" id="checkboxSuccess" value="public">
                Make app Public
            </label>
        @endif
    </div>                  
  </div>

  <!--App main settings-->
  <div class="col-md-4">
    <h3>Settings</h3>
  </div>
  <div class="col-md-8">
    <div class="form-group">
      <label for="board">Board</label>
      <br>
      <select class="form-control">
        @foreach($boards as $board)
          @if ($board->board_name == $userapp->board_name)
            <option value="{{$board->id}}" selected>{{$board->board_name}}</option>
          @else
            <option value="{{$board->id}}">{{$board->board_name}}</option>
          @endif
        @endforeach

      </select>
    </div>
  </div>

  <!--App Sample Code-->
  <div class="col-md-4">
    <h3>Sample Code</h3>
  </div>
  <div class="col-md-8">
    <div class="form-group has-success">
      <h4>Code Settings <i class="fa fa-caret-down"></i></h4>

      <div class="col-xs-offset-1">
        <span class="text-info">Inputs</span>
        <samp>
          <h5>Enable</h5>
            <p class="text-warning">Digital Pins</p>
            @foreach($digitalInputs as $digital_input)
              <label for="digitalInputs[]" class="inputs">
                  <input type="checkbox" id="checkboxSuccess" name="digitalInputs[]" value="{{$digital_input->board_input}}" >
                  {{$digital_input->user_input}}
              </label>
            @endforeach
            <hr>

            <p class="text-warning">Analog Pins</p>
              @foreach($analogInputs as $analog_input)
                <label for="analogInputs[]" class="inputs">
                    <input type="checkbox" id="checkboxSuccess" name="analogInputs[]" value="{{$analog_input->board_input}}" >
                    {{$analog_input->user_input}}
                </label>
              @endforeach
            <hr>

            <p class="text-warning">Communication</p>
            @foreach($communicationInputs as $communication_input)
              <label for="communicationInputs[]" class="inputs">
                  <input type="checkbox" id="checkboxSuccess" name="communicationInputs[]" value="{{$communication_input->board_input}}" >
                  {{$communication_input->user_input}}
              </label>
            @endforeach
            <hr>
        </samp>
      </div>
    </div>
    <div class="form-group">
      <h4>Sample Code <i class="fa fa-caret-down"></i></h4>
      <samp>
        <textarea class="form-control" rows="30">
          {{$userapp->app_code}}
        </textarea>
      </samp>
    </div>     
  </div>

  <!--Keys and Access tokens-->
  <div class="col-md-4">
    <h3>Keys and Access Tokens</h3>
  </div>
  <div class="col-md-8">
    <h5>App's API Key</h5>
    <code>{{$userapp->app_key}}</code>
    <br>
    <br>

    <p class="text-warning">Do not share your API secret with anyone.
        <h5>App's API Secret</h5>
        <code>{{$userapp->app_secret}}</code>
    </p>      
  </div>    
</form>