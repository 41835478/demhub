
    <div class="row">
        <h5 class="pull-right">{{$totalCount}} {{$label}} found for "{{$queryTerm}}"</h5>
        <h3 class="pull-left text-bold">
            <a href="">{{$label}} <small>View All</small></a>
        </h3>
    </div>
    <div class="row">
        @for($i=0; $i<2; $i++)
            @if(isset($results[$i]))
                @include('frontend.includes._card', ['item'=>$results[$i], 'type'=>'summary']);
            @endif
        @endfor
    </div>
    <div class="row">
        <a href="" class="btn btn-danger pull-right">View All</a>
    </div>
