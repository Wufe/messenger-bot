<?php

	namespace App\Webhook\Exceptions;

	use Exception;

	class WebhookException extends Exception{

		public function __construct( $message ){
			parent::__construct( $message );
		}

	}