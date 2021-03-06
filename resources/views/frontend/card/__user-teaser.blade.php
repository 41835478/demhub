<div class="peoplebox-teaser">
    <div class="pull-left" style="height: 125px; max-width:18px; margin: -15px 0; position: absolute;">
        <?php
        $height = 100;
        if (count($user->division) > 0) {
            $height = 100 / count($user->division);
        }; ?>
        @if($user->divisions() == NULL)
            <div style="height:100%;" class="color-label-vertical division_all"
                 data-toggle="tooltip" data-placement="top" title="All Divisions">
            </div>
        @else
            @foreach($user->divisions() as $slug => $div)
                <div style="height:{{$height}}%;" class="color-label-vertical division_{{$slug}}"
                     data-toggle="tooltip" data-placement="top" title="{{$div}}">
                </div>
            @endforeach
        @endif
    </div>
    <div class="">
        <div class="col-xs-3 text-center">
            {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => 'margin:0 0 0 10px;max-width: 95px;max-height: 95px;']) !!}
        </div>
        <div class="col-xs-9">
            <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
                <h3 style="margin: 0 0 5px 0;">  {{$user->full_name()}}  </h3>
            </a>
            <div class="row">
                <div class="col-xs-8">
                    <p class="orange-hover" style="margin-bottom:0px">{{$user->job_title}}
                        @if ($user->organization_name)
                            <span style="text-transform:lowercase">at</span> {{$user->organization_name}}
                        @endif
                    </p>
                    <p style="color:#999">
                        {{$user->location}}
                    </p>
                </div>
                <div class="col-xs-4 text-center">
                    <div class="text-center">
                        <h4 style="margin:0px 0 5px 0">
                            {{count($user->followers)}} <small style="color:#999">followers</small>
                        </h4>
                    </div>
                    @include('frontend.card.__follow_button')
                </div>
            </div>
        </div>
    </div>
</div><!-- the div that closes the peoplebox -->

<?php /*
<div class="peoplebox-teaser">
    <?php
    $height = 100;
    if (count($user->division) > 0) {
        $height = 100 / count($user->division);
    }; ?>
    <div class="col-xs-1" style="height: 140px;margin-left:-15px;max-width:30px;margin-top:-15px">
        @if($user->divisions() == NULL)
            <div style="height:100%;" class="color-label-vertical division_all"
                 data-toggle="tooltip" data-placement="top" title="All Divisions">
            </div>
        @else
            @foreach($user->divisions() as $slug => $div)
                <div style="height:{{$height}}%;" class="color-label-vertical division_{{$slug}}"
                     data-toggle="tooltip" data-placement="top" title="{{$div}}">
                </div>
            @endforeach
        @endif
    </div>
    <div class="col-xs-10 col-xs-offset-1 inner-peoplebox">
        <div class="col-xs-1">
            <div class="" style="">
                {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', ['class' => "img-circle img-responsive", 'style' => 'max-height:110px;max-width:100px;margin-top:-8px;margin-left:-25px']) !!}
            </div>
        </div>
        <div class="col-xs-6 col-xs-offset-2 people-card-info" style="text-align:left;">
            <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
                <h3 style="margin-top:5px">  {{$user->full_name()}}  </h3>
            </a>

            <p class="orange-hover" style="margin-bottom:0px">{{$user->job_title}}
                @if ($user->organization_name)
                    <span style="text-transform:lowercase">at</span> {{$user->organization_name}}
                @endif
            </p>
            <p style="color:#999">
                {{$user->location}}
            </p>


        </div>
        <div class="col-xs-2" style="text-align:center;padding-left:32px">
            <div style="margin: 0 auto; width:100%; height:40px; position:absolute;">
                @include('frontend.card.__follow_button')

                <div style="padding-left:5%">
                    <h3 style="margin-bottom:0px">{{count($user->followers)}}</h3>
                    <p style="color:#999">followers</p>
                </div>
            </div>
        </div>
    </div> <!-- the div that closes the inner-feedsbox -->

</div>
*/ ?>
