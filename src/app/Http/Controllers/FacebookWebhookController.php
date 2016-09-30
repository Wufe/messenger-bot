<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Log;

class FacebookWebhookController extends Controller
{
	public function validateWebhook( Request $request ){

		Log::info( $request->fullUrl()."\n".print_r($request->all(),true) );
		$isHubModeValid = $request->has( "hub_mode" ) && $request->hub_mode === "subscribe";
		$isConfigurationKeyValid = $request->has( "hub_verify_token" ) && $request->hub_verify_token == config("app.key");
		$hasHubChallenge = $request->has( "hub_challenge" );
		if( $isHubModeValid && $isConfigurationKeyValid && $hasHubChallenge ){
			Log::info( "Validated webhook with challenge ".$request->hub_challenge."." );
			return response( $request->hub_challenge );
		}else{
			if( !$isHubModeValid ){
				Log::info( "Hub mode not valid." );
			}
			if( !$isConfigurationKeyValid ){
				Log::info( "Configuration key not valid." );
			}
			if( !$hasHubChallenge ){
				Log::info( "Challenge missing." );
			}
			Log::info( "Failed webhook validation." );
			return response(403);
		}
		
		//if( $request->has( "hub_mode" ))
		//return response()->json([ "status" => "ok", "config" => config("app.key"), "fullUrl" => $request->fullUrl(), "all" => $request->all() ], 200);
	}
 //    app.get('/webhook', function(req, res) {
	//   if (req.query['hub.mode'] === 'subscribe' &&
	//       req.query['hub.verify_token'] === VALIDATION_TOKEN) {
	//     console.log("Validating webhook");
	//     res.status(200).send(req.query['hub.challenge']);
	//   } else {
	//     console.error("Failed validation. Make sure the validation tokens match.");
	//     res.sendStatus(403);          
	//   }  
	// });
}
