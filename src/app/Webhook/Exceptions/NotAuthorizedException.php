<?php

	namespace App\Webhook\Exceptions;

	use App\Webhook\Exceptions\WebhookException;

	class NotAuthorizedException extends WebhookException{

		public function __construct(){
			$message = 'Issuer not authorized.';
			parent::__construct( $message );
		}

	}