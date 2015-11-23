<?php

namespace spec\App\Models;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Models\Division;

class DivisionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Models\Division');
    }
    function get_slug_string(){
      $this::find(1);
      $this->slug -> shouldBeString();
    }
}
