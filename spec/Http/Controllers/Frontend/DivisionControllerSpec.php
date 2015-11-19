<?php

namespace spec\App\Http\Controllers\Frontend;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use App\Models\Division;
use DB;
use Illuminate\Http\Request;

class DivisionControllerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\Frontend\DivisionController');
    }
    // function search_request(Request $request){
    //   $request;
    //
    // }

}
