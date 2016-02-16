@extends('frontend.layouts.master')

@section('content')
    <style>
        .search-division{
            opacity: 0.6;
            border-radius: 0px;
            text-align: center;
            color: #ffffff;
            text-transform: uppercase;
        }
        .search-division.active,
        .search-division:hover{
            opacity: 1;
        }

        /* TODO: Fix the following CSS to be completely consistent */
        @media (min-width: 1200px) {
            .search-division {
                padding: 13px 3%;
                height: 56px;
            }
        }
        @media (min-width: 992px) and (max-width: 1199px) {
            .search-division {
                padding: 13px 0;
                height: 72px;
            }
        }

        @media (min-width: 768px) and (max-width: 992px) {
            .search-division {
                padding: 13px 0;
                height: 72px;
            }
        }

        @media only screen and (max-width: 767px) {
            .search-division {
                padding: 13px 0;
                height: 72px;
            }
        }
    </style>

    <div class="container-fluid row">
        <div class="col-xs-12 col-md-offset-1 col-md-10">
            @foreach($divisions as $index => $div)
                <div class="col-xs-4 col-sm-2" style="height:100%;padding-top:10px;padding-bottom:10px;">
                    <a href="{{ url('search').'?scope='.$scope.'&query_term='.$query_term.'&division='.$div->slug }}">
                        <h5 class="search-division division_{{$div->slug}} @if($div->slug==$division) active @endif">
                            {{$div->name}}
                        </h5>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-offset-2 col-sm-8">
            <div class="container-fluid row">
                <h5 class="pull-left">
                    Showing
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
