<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use App\Webhook\Request\Parser;
use App\Webhook\Exceptions\DataMissingException;
use App\Webhook\Exceptions\ProtocolNotImplementedException;
use App\Webhook\Exceptions\WebhookException;

class Webhook
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

        $parser = new Parser( $request );

        try{
            $isRequestValid = $parser->isValid();
        }catch( WebhookException $e ){
            return response()->fail( $e->getMessage(), 400 );
        }

        $payload = $parser->getPayload();


        $request->merge([
            "messages" => $payload
        ]);
        return $next($request);
    }
}
