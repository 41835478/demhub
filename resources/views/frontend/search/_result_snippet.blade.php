<?php $url = url('search').'?scope='.$scope.'&query_term='.$query_term; ?>
<div class="container-fluid card-subtle">

    <div class="row">
        <div class="col-xs-12">
            <h6 class="pull-right" style="margin: 30px 0 0 0;color:#aaa">
              <?php echo ($query_term=='') ? 'Many ': $totalCount.' '; ?>
              {{$label}} found {{ $totalCount>0 ? 'for "'.$query_term.'"' : ""  }}
            </h6>
            <a href="{{$url}}">
                <h3 class="pull-left text-bold" style="color: #000">
                        {{$label}} <small>View All</small>
                </h3>
            </a>
        </div>
    </div>

    @if($totalCount > 0)
    <div class="row" style="position: relative;overflow: hidden;">
        @for($i=0; $i<2; $i++)
            @if(isset($results[$i]))
                <div class="col-xs-12 col-sm-6">
                    @include('frontend.card._card', ['item'=>$results[$i], 'type'=>'summary'])
                </div>
            @endif
        @endfor
        <div class="col-sm-1 hidden-xs" style="position: absolute;right: 0;background: rgb(255, 255, 255);height: 65vh;box-shadow: -3px 0px 10px rgba(0,0,0,0.2);">
            <a href="{{$url}}">
                <i class="fa fa-4x fa-angle-right" style="line-height: 50vh;color: #bbb;"></i>
            </a>
        </div>
    </div>

    <div class="row" style="margin-top: 10px">
        <div class="col-xs-12">
            <a href="{{$url}}" class="btn btn-danger pull-right">View All</a>
        </div>
    </div>
    @endif
</div>
