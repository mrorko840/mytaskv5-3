<?php

namespace Laramin\Utility;

use Closure;
use App\Models\GeneralSetting;

class Utility{

    public function handle($request, Closure $next)
    {
        // if (!Helpmate::sysPass()) {
        //     return redirect()->route(VugiChugi::acRouter());
        // }
        
        // if( $_SERVER['SERVER_NAME'] != gs()->code ){
        //     return redirect()->route(VugiChugi::acRouter());
        // }

        $general = GeneralSetting::first();
        if( $_SERVER['SERVER_NAME'] != $general->code ){
            return redirect()->route(VugiChugi::acRouter());
        }

        return $next($request);
    }
}
