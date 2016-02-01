
<div class="container-fluid row">
    <div class="col-xs-12 col-md-offset-2 col-md-8">
        <div class="row">
            @foreach($divisions as $div)
                <div class="col-xs-2 {{if($div==$division) active}}" style="background-color: {{$div->bg-color}};">
                    {{$div->slug}}
                </div>
            @endforeach

            @foreach($items as $item)
                <div class="col-xs-12 col-sm-6"></div>
            @foreach
        </div>
    </div>
</div>