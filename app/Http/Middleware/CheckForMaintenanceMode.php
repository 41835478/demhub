<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;

class CheckForMaintenanceMode implements Middleware {

    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance())
        {
            return response('<p style="text-align:center"><img src="http://staging.demhub.net/images/logo/demhub_logo-05_black.png" class="demhub-logo-landing" width="190" alt="DEMHUB logo"></p>
            <p style="text-align:center">We are doing some site maintenance. We will be back momentarily!</p>', 503);
        }

        return $next($request);
    }
  }
