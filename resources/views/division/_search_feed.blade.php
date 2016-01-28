

<div class="col-md-7 col-md-offset-2" style="overflow-x:hidden">

  <div id="ph-text" class="text-left">

    @foreach($newsFeeds->get_items() as $item)

      @if(!isset($pattern) || isset($pattern) && (preg_match($pattern, $item->get_title()) == true || preg_match($pattern, $item->get_description()) == true) )

        <div class="col-md-12">
          <h3>
            <a
              @if(Auth::check())
                target="_blank" href="{{ $item->get_link() }}"
              @else
                href="" data-toggle="modal" data-target="#DEMHUBModal"
                @endif
            style="color:#000">
            {{ $item->get_title() }}
            </a>
          </h3>

          <span class="label label-card" style="font-size:82%">
            {{$item->get_date('j F Y | g:i a')}}
          </span>

          <?php
            $description = $item->get_description();
            if (preg_match_all('/(https?:\/\/\S+\.(?:jpg|png|gif))\s+/', $description, $img)){
              echo $img[0][0];
            }
          ?>

          <p>
            <?php
            $description = $item->get_description();
              if (strlen($description) > 225){
                $str = substr($description, 0, 225) . '...';
                echo strip_tags($str, '<img>');
              } else{
                echo strip_tags($description, '<img>');
              }
            ?>
          </p>

          <hr>
        </div>

      @endif

    @endforeach

  </div>

</div>
