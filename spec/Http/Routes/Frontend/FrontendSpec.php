<?php

namespace spec\App\Http\Routes\Frontend;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Models\Division;

class FrontendSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Routes\Frontend\Frontend');
    }
    // function division_directory(Division $division){
    //   get('division/'$division->slug, 'DivisionController@show')->where('slug', '[A-Za-z_\-]+');
    // }
}
