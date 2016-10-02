<?php

	namespace App\Webhook\Request;

	use Exception;
	use App\Webhook\Exceptions;
	use Illuminate\Http\Request;

	class Parser{

		private $request;
		private $parsedPayload = [];
		private $valid = false;

		const EVENT_MESSAGE = 'message';
		const EVENT_OPTIN = 'optin';
		const EVENT_DELIVERY = 'delivery';
		const EVENT_POSTBACK = 'postback';

		public function __construct( Request $request ){
			$this->request = $request;
		}

		public function getPayload(){
			return $this->parsedPayload;
		}

		public function isValid(){
			$this->parse();
			$this->valid = true;
			return $this->valid;
		}

		private function parse(){
			$this->checkRootRequirements();
			$this->parseEntries();
		}

		private function checkRootRequirements(){
			$this->checkObjectField();
			$this->checkEntries();
		}

		private function checkObjectField(){
			$requestHasObject = $this->request->has( 'object' );
			if( !$requestHasObject )
				throw new Exceptions\DataMissingException( 'object' );
			$requestObject = $this->request->object;
			$isObjectAPage = $requestObject == 'page';
			if( !$isObjectAPage )
				throw new Exceptions\ProtocolNotImplementedException( $requestObject );
		}

		private function checkEntries(){
			$requestHasEntry = $this->request->has( 'entry' );
			if( !$requestHasEntry )
				throw new Exception\DataMissingException( 'entry' );
		}

		private function parseEntries(){
			$entries = $this->request->entry;
			foreach( $entries as $entry ){
				try{
					$this->checkPageEntry( $entry );
					$messagingEvents = $entry['messaging'];
					foreach( $messagingEvents as $messagingEvent ){
						$this->manageMessagingEvent( $messagingEvent );
					}
				}catch( Exceptions\WebhookException $e ){}
			}
		}

		private function manageMessagingEvent( $messagingEvent ){
			$messagingEventType = $this->getMessagingEventType( $messagingEvent );
			$messagingEvent['type'] = $messagingEventType;
			$this->checkMessagingEvent( $messagingEvent );
			$this->parsedPayload[] = $messagingEvent;
		}

		private function checkMessagingEvent( $messagingEvent ){
			$hasSender = isset( $messagingEvent['sender'] );
			if( !$hasSender )
				throw new Exceptions\DataMissingException( 'event.sender' );
			$sender = $messagingEvent['sender'];
			$hasSenderID = isset( $sender['id'] );
			if( !$hasSenderID )
				throw new Exceptions\DataMissingException( 'event.sender.id' );
			$hasMessage = isset( $messagingEvent['message'] );
			if( !$hasMessage )
				throw new Exceptions\DataMissingException( 'event.message' );
			$message = $messagingEvent['message'];
			$hasMessageText = isset( $message['text'] );
			if( !$hasMessageText )
				throw new Exceptions\DataMissingException( 'event.message.text' );
		}

		private function checkPageEntry( $entry ){
			$this->checkPage( $entry );
			$hasTime = isset( $entry['time'] );
			if( !$hasTime )
				throw new Exceptions\DataMissingException( 'entry.time' );
			$hasMessaging = isset( $entry['messaging'] );
			if( !$hasMessaging )
				throw new Exceptions\DataMissingException( 'entry.messaging' );
		}

		private function checkPage( $entry ){
			$hasPageID = isset( $entry['id'] );
			if( !$hasPageID )
				throw new Exceptions\DataMissingException( 'entry.id' );
			$environmentPageID = config( 'app.page_id' );
			if( $environmentPageID ){
				$pageID = $entry['id'];
				
				if( $pageID != $environmentPageID ){
					throw new Exceptions\NotAuthorizedException();	
				}
			}
			
		}

		private function getMessagingEventType( $messagingEvent ){
			if( isset( $messagingEvent[self::EVENT_MESSAGE] ) )
				return self::EVENT_MESSAGE;
			if( isset( $messagingEvent[self::EVENT_OPTIN] ) )
				return self::EVENT_OPTIN;
			if( isset( $messagingEvent[self::EVENT_DELIVERY] ) )
				return self::EVENT_DELIVERY;
			if( isset( $messagingEvent[self::EVENT_POSTBACK] ) )
				return self::EVENT_POSTBACK;
		}


	}