<?php

	namespace App\Webhook\Exceptions;

	use App\Webhook\Exceptions\WebhookException;

	class DataMissingException extends WebhookException{

		public function __construct( $missingData ){
			$message = "The request has some missing field ($missingData).";
			parent::__construct( $message );
		}

	}