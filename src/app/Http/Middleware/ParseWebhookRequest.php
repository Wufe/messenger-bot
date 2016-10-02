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
        $return = [];
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
            $pageID = $pageEntry[ 'id' ];
            $timeOfEvent = $pageEntry[ 'time' ];

            $messaging = $pageEntry[ 'messaging' ];
            foreach( $messaging as $messagingEvent ){
                if( isset( $messagingEvent[ "message" ] ) ){
                    $return[] = [
                        "type" => "message",
                        "payload" => $messagingEvent
                    ];
                    Log::info( $messagingEvent[ "message" ][ "text" ] );
                }elseif( isset( $messagingEvent[ "optin" ] ) ){
                    $return[] = [
                        "type" => "optin",
                        "payload" => $messagingEvent
                    ];
                }elseif( isset( $messagingEvent[ "delivery" ] ) ){
                    $return[] = [
                        "type" => "delivery",
                        "payload" => $messagingEvent
                    ];
                }elseif( isset( $messagingEvent[ "postback" ] ) ){
                    $return[] = [
                        "type" => "postback",
                        "payload" => $messagingEvent
                    ];
                }
            }
        }
        $request->attributes->add( "messages", $return );
        return $next($request);
    }
}
