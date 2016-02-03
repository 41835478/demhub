@extends('frontend.layouts.master')

@section('content')
<style>
    .search-division{
        opacity: 0.2;
        border-radius: 5px;
        text-align: center;
        padding: 10px 0;
        color: #ffffff;
        text-transform: uppercase;
        font-weight: bold;
    }
    .search-division.active,
    .search-division:hover{
        opacity: 1;
    }
</style>
<script>
    $(document).ready(function(){
        var box_height = 0;
        $('.feedsbox').each(function(index){
            if($(this).height() > box_height)
                box_height = $(this).height();
        });
        $('.feedsbox').css('height', box_height);
    });
</script>
<div class="container-fluid row">
    <div class="col-xs-12 col-sm-offset-2 col-sm-8">
        <div class="row">
            @foreach($divisions as $div)
                <div class="col-xs-4 col-sm-2">
                    <a href="{{ url('search').'?scope='.$scope.'&query_term='.$queryTerm.'&division='.$div->slug }}">
                        <h5 class="search-division division_{{$div->slug}} @if($div->slug==$division) active @endif">
                            {{$div->slug}}
                        </h5>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="container-fluid row">
            <h5 class="pull-left">{{$totalCount}} results</h5>
        </div>

        <div class="row">
            @foreach($items as $item)
            <div class="col-xs-12 col-sm-6">
                @include('frontend.card._card', ['item'=>$item, 'type'=>'summary'])
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop