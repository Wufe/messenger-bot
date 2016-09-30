<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ParseWebhookRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hasObject = $request->has( 'object' );
        if( !$hasObject )
            return response()->fail( "No object parameter.", 400 );
        $isPageObject = $request->object == "page";
        if( !$isPageObject )
            return response()->fail( "Not a page.", 400 );
        $hasEntry = $request->has( 'entry' );
        if( !$hasEntry )
            return response()->fail( "No entry.", 400 );
        $entry = $request->entry;
        foreach( $entry as $pageEntry ){
            //$pageID = $pageEntry[ 'id' ];
            Log::info( print_r( $entry, true ) );
        }
        return $next($request);
    }
}
