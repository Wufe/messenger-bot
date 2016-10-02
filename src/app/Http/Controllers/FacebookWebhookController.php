<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Config;

use Illuminate\Support\Facades\Log;

use Requests as HttpRequest;

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
			return response(null, 403);
		}
	}

	public function receiveRequest( Request $request ){
		if( $request->has( 'messages' ) ){
			$payload = $request->messages;
			foreach( $payload as $message ){
				if( isset( $message["type"] ) ){
					$messageType = $message["type"];
					if($messageType){
						if( isset( $message["payload"] ) ){
						//if( isset( $message["payload"] ) ){
							if( isset( $message["payload"]["sender"] ) &&
								isset( $message["payload"]["sender"][ "id" ] ) &&
								isset( $message["payload"]["message"] ) &&
								isset( $message["payload"]["message"]["text"] ) ){
								$sender = $message["payload"]["sender"]["id"];
								$text = $message["payload"]["message"]["text"];
								$this->sendTextMessage( $sender, $text );
							}else{
								Log::info( "data missing" );
							}
							
						}
						
					}
				}
				
			}
		}
		return response()->success();
	}

	public function sendTextMessage( $recipient, $message ){
		$messageData = [
			"recipient" => [
				"id" => $recipient
			],
			"message" => [
				"text" => $message
			]
		];
		return $this->callSendAPI( $messageData );
	}

	private function callSendAPI( $messageData ){
		$pageKey = config("app.page_key");
		$headers = [ 'Content-Type' => 'application/json' ];
		$uri = "https://graph.facebook.com/v2.6/me/messages?access_token=".$pageKey;
		$response = HttpRequest::post( $uri, $headers, json_encode( $messageData ) );
		return response( $response->body );
	}
}
