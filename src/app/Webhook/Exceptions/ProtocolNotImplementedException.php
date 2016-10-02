<?php

	namespace App\Webhook\Exceptions;

	use App\Webhook\Exceptions\WebhookException;

	class ProtocolNotImplementedException extends WebhookException{

		public function __construct( $missingProtocol ){
			$message = "The protocol '$missingProtocol' is not implemented.";
			parent::__construct( $message );
		}

	}