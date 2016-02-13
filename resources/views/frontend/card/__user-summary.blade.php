<?php
    $width = 100;
    if(count($user->divisions()) > 0) {
        $width = 100 / count($user->divisions());
    }

    $followers_count = count($user->followers);
    $publications_count = count($user->publications);
    
    $description = null;
    if ($user->bio) {
        $description = $user->bio;
        if (strlen($description) > 205){
            $description = substr($description, 0, 205) . '...';
        }
    }
?>

<div class="peoplebox">
    {{-- NOTE : this view assumes that $user is an instance of the User Model, not an array --}}
    @if($user->divisions() == NULL)
        <div class="color-label division_all" data-toggle="headsup" data-placement="top" title="All Divisions" style="z-index:1"></div>
    @else
        @foreach($user->divisions() as $slug => $div)
            <div class="color-label division_{{$slug}} col-xs-6"
                 style="width:{{$width}}%; margin:0;"
                 data-toggle="headsup" data-placement="top" title="{{$div}}">
            </div>
        @endforeach
    @endif

    <div class="inner-peoplebox" style="text-align:center;">
        <div class="row" style="padding-top:20px;">
            {!! HTML::image($user->avatar->url('medium'), '$user->avatar_file_name', [
                'class' => "img-circle img-responsive", 'style' => 'max-height:95px;max-width:80px;margin: 0 auto'
            ]) !!}

            <div class="container-fluid">
                <a class="main-blue-color" href="{{ URL::to('profile/' . $user->user_name) }}">
                    <h3>{{$user->full_name()}}</h3>
                </a>

                <p class="main-orange" style="margin-bottom:0px;display:inline-block">{{$user->job_title}}</p>

                @if ($user->organization_name)
                    <p class="main-orange" style="display:inline-block;margin-bottom:0;">
                        <span style="text-transform:lowercase">at</span> {{$user->organization_name}}
                    </p>
                @endif

                <p style="color:#999">
                    {{$user->location}}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-4">
                <h3 style="margin-bottom:0px">{{$followers_count}}</h3>
                <p style="color:#999">{{$followers_count == 1 ? 'follower' : 'followers'}}</p>
            </div>
            <div class="col-xs-4">
                <h3 style="margin-bottom:0px">{{$publications_count}}</h3>
                <p style="color:#999">{{$publications_count == 1 ? 'publication' : 'publications'}}</p>
            </div>
            <div class="col-xs-4" style="padding-top:20px;padding-left:0px;">
                @include('frontend.card.__follow_button')
            </div>
        </div>

        <div class="row">
            @if ($description)
                <p style="color:#999;padding-left:20px;padding-right:20px">
                    {{$description}}
                </p>
            @endif
        </div>
    </div> <!-- the div that closes the inner-feedsbox -->

</div> <!-- the div that closes the peoplebox -->
