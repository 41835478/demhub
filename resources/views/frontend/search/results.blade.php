@extends('frontend.layouts.master')

@section('content')
<style>
    .search-division{
        opacity: 0.6;
        border-radius: 0px;
        text-align: center;
        padding: 13px 0;
        color: #ffffff;
        text-transform: uppercase;
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
        <div class="row" style="margin: 10px -75px 20px -75px;">
            @foreach($divisions as $div)
                <div class="col-xs-4 col-sm-2">
                    <a href="{{ url('search').'?scope='.$scope.'&query_term='.$query_term.'&division='.$div->slug }}">
                        <h5 class="search-division division_{{$div->slug}} @if($div->slug==$division) active @endif">
                            {{$div->slug}}
                        </h5>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="container-fluid row">
            <h5 class="pull-left">Showing
                {{($page-1)*$size}} - {{ ($page*$size)>$totalCount ? $totalCount : ($page*$size) }}
                of {{$totalCount}} results
            </h5>
        </div>

        <div class="row">
            @foreach($items as $item)
            <div class="col-xs-12 col-sm-6">
                @include('frontend.card._card', ['item'=>$item, 'type'=>'summary'])
            </div>
            @endforeach
        </div>

        <div class="container-fluid row text-center" style="margin: 20px 0 50px 0;">
            @for($i=1; $i < ($totalCount / $size); $i++)
                <a href="{{ url('search').'?scope='.$scope.'&query_term='.$query_term.'&division='.$div->slug.'&page='.$i }}"
                    class="btn pull-left {{$i == $page ? 'btn-link' : 'btn-default'}}" style="margin-right:5px">
                    {{$i}}
                </a>
            @endfor
        </div>
    </div>
</div>
@stop
