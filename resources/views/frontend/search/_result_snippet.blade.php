<?php $url = url('search', ['scope'=>$scope]); ?>
<div class="container-fluid card-subtle">

    <div class="row">
        <div class="col-xs-12">
            <h6 class="pull-right" style="margin: 30px 0 0 0;color:#aaa">
                {{$totalCount}} {{$label}} found for "{{$queryTerm}}"
            </h6>
            <a href="{{$url}}">
                <h3 class="pull-left text-bold" style="color: #000">
                        {{$label}} <small>View All</small>
                </h3>
            </a>
        </div>
    </div>
    
    <div class="row">
        @for($i=0; $i<2; $i++)
            @if(isset($results[$i]))
                <div class="col-xs-12 col-sm-5">
                    @include('frontend.card._card', ['item'=>$results[$i], 'type'=>'summary'])
                </div>
            @endif
        @endfor
        <div class="col-sm-1 hidden-xs text-right">
            <a href="{{$url}}">
                <i class="fa fa-4x fa-angle-right" style="line-height: 4em;color: #bbb;"></i>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <a href="{{$url}}" class="btn btn-danger pull-right">View All</a>
        </div>
    </div>

</div>
