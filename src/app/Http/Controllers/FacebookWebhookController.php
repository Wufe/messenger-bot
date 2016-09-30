<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FacebookWebhookController extends Controller
{
	public function validateWebhook(){
		return response()->json([ "status" => "ok" ], 200);
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
