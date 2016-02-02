
<div class="container-fluid row">
    <div class="col-xs-12 col-md-offset-2 col-md-8">
        <div class="row">
            @foreach($divisions as $div)
                <div class="col-xs-2 search-division division-{{$div->slug}} {{if($div->slug==$division) active}}">
                    <a href="{{ url('search', ['scope'=>$scope, 'query_term'=>$queryTerm, 'division'=>$div->slug, 'page'=>$page]) }}">
                        {{$div->slug}}
                    </a>
                </div>
            @endforeach

            <div class="container-fluid row">
                <h5 class="pull-left">{{$totalCount}} results</h5>
            </div>

            @foreach($items as $item)
                <div class="col-xs-12 col-sm-6">
                    @include('frontend.includes._card', ['item'=>$item, 'type'=>'summary']);
                </div>
            @foreach
        </div>
    </div>
</div>