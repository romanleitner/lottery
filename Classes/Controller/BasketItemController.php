<?php
namespace WX\WxLottery\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Roman Leitner <rl@webaholix.com>, webaholix s.r.o.
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package wx_lottery
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class BasketItemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * basketItemRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\BasketItemRepository
	 * @inject
	 */
	protected $basketItemRepository;
	
	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * ticketRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\TicketRepository
	 * @inject
	 */
	private $ticketRepository;

	private $sessionData;

	private $ticketId = 0;

   /**
	 * inject the session variable
	 *
	 * @return void
	 */
	public function __construct(){
		$this->sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if( \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('basketItemId') > 0 ): $this->updateBasketWithAjax(); endif;
		$input = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('tx_wxlottery_basket');
		$inputTicket = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('tx_wxlottery_list');

		// Check if cookies are enabled (created in ticket list action)
		if( $inputTicket['productId'] AND !is_array($this->sessionData) ){
			$this->view->assign('enableSession', 1);
			return $this->view->render();
		}

		if( strlen($this->sessionData['sessionId']) > 0 ){
			// Delete basketItem
			if( $this->request->hasArgument('delete') ){
				if( is_array ( $this->request->getArgument ( 'delete' ) ) ) {
					$input = array_keys ( $this->request->getArgument ( 'delete' ) );
					$basketItemId = $input[0];
				} else {
					$basketItemId = $this->request->getArgument ( 'delete' );
				}
				$this->deleteBasketItem($basketItemId);
			}

			// Recalculate basket price
			if( is_array($input) AND array_key_exists('recalculate', $input) ){
				$this->recalculateBasket( $input['amount'] );
			}

			if( $inputTicket['productId'] AND $this->validateProductId() ){
	            $this->addProductToBasket($inputTicket['pieces']);
			}

			$this->updateJokerInBasket();
			$basketItems = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
			$chances = array();
			foreach ($basketItems as $basketItem) {
				$nrOfProducts = $basketItem->getAmount()*$basketItem->getTicket()->getNrOfTickets();
				$chances[$basketItem->getUid()] = $this->getChanceOfWinning($nrOfProducts); 
			}

			$this->view->assign( 'basketItems', $basketItems );
			$this->view->assign( 'chances', $chances );
			$this->view->assign( 'basketTotal', $this->getBasketTotal($basketItems) );
			$this->view->assign( 'jokerId', $this->settings['joker']['uid'] );
			$this->view->assign( 'langId', $GLOBALS['TSFE']->sys_language_uid );
		}
	}

	/**
	 * action delete
	 *
	 * @param \WX\WxLottery\Domain\Model\BasketItem $basketItem
	 * @return void
	 */
	public function deleteAction(\WX\WxLottery\Domain\Model\BasketItem $basketItem) {
		$this->basketItemRepository->remove($basketItem);
		$this->flashMessageContainer->add('Your BasketItem was removed.');
		$this->redirect('list');
	}

	/*
	 * Add special product to basket
	 *
	 * @return void
	 */
	private function updateJokerInBasket(){
      $inputTicket = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('tx_wxlottery_list');

		if( $inputTicket['joker'] != 1 AND $this->basketItemRepository->findIsInBasket($this->sessionData['sessionId'], $this->settings['joker']['uid']) == 0 ){
			return false;
		}

  		if( $this->settings['joker']['uid'] > 0 ){
         $basketItems = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
         foreach ($basketItems as $basketItem) {
				if( $this->settings['joker']['uid'] != $basketItem->getTicket()->getUid() )
         	$amount += ( $basketItem->getAmount() * $basketItem->getTicket()->getNrOfTens() );
         }

			// First check if we dont have joker in basket already
			$jokerBasketItem = $this->basketItemRepository->findBasketItem( $this->sessionData['sessionId'], $this->settings['joker']['uid']);

         if($jokerBasketItem->count() > 0){
            $jokerBasketItem = $jokerBasketItem->getFirst();
            $jokerBasketItem->setAmount( $amount );
            $this->basketItemRepository->update( $jokerBasketItem );
			}else{
				$jokerBasketItem = new \WX\WxLottery\Domain\Model\BasketItem;
				$jokerBasketItem->setPid( 29 );
				$jokerBasketItem->setSessionId( $this->sessionData['sessionId'] );
		  		$jokerBasketItem->setIpAddress( $_SERVER['REMOTE_ADDR'] );
				$jokerBasketItem->setUserAgent( $_SERVER['HTTP_USER_AGENT'] );
				$jokerBasketItem->setTime( time() );
				$jokerBasketItem->setAmount( $amount );
				$jokerBasketItem->setTicket( $this->ticketRepository->findByUid($this->settings['joker']['uid']) );
				$this->basketItemRepository->add( $jokerBasketItem );
			}

			// workaround - or the right way?
//    		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Persistence_Manager');

//	[L:] No, manager is injected in construct ;)
			$this->persistenceManager->persistAll();
			$this->sessionData['joker'] = 1;
			$GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $this->sessionData);
			$GLOBALS['TSFE']->storeSessionData();
		}
	}

	/*
	 * Add product to basket
	 *
	 * @return void
	 */
	private function addProductToBasket($pieces){
		//Check if ticket is not in basket already
		if($this->basketItemRepository->findIsInBasket( $this->sessionData['sessionId'], $this->ticketId ) == 0){
			$ticket = $this->ticketRepository->findByUid($this->ticketId);
			$basketItem = new \WX\WxLottery\Domain\Model\BasketItem;
			$basketItem->setPid( 29 );
			$basketItem->setSessionId( $this->sessionData['sessionId'] );
			$basketItem->setIpAddress( $_SERVER['REMOTE_ADDR'] );
			$basketItem->setUserAgent( $_SERVER['HTTP_USER_AGENT'] );
			$basketItem->setTime( time() );
			$basketItem->setAmount( intval($pieces[$this->ticketId]) );
			$basketItem->setTicket( $ticket );
			$this->basketItemRepository->add( $basketItem );

			//	workaround - or the right way?
			//	$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Persistence_Manager');
			//	$persistenceManager->persistAll(); // <- save i database
			//	[L:] No, manager is injected in construct ;)
			$this->persistenceManager->persistAll();
		}

	}

	/*
	 * Create session for current user
	 *
	 * @return void
	 */
	private function createSessionKey(){

		if( $this->sessionData == NULL ){
         $this->sessionData['sessionId'] = md5( time() . $_SERVER['HTTP_USER_AGENT'] );

			$GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $this->sessionData);
			$GLOBALS['TSFE']->storeSessionData();
		}
	}

	/*
	 * Validate format of received product ID
	 *
	 * @return boolean
	 */
	private function validateProductId(){
		$input = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('tx_wxlottery_list');
		$parts = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode( '-', $input['productId'] );
      $validSteps = 0;

		if(count($parts) == 2){
			$validSteps++;
		}else{
         $this->flashMessageContainer->add('Invalid ticket ID sent!');
		}

		if( $parts[0] == 'ticket' ){
			$validSteps++;
		}else{
			$this->flashMessageContainer->add('Invalid ticket ID sent.');
		}

      $foo = $this->ticketRepository->findByUid( intval( $parts[1] ) );
      //if( $this->ticketRepository->countByUid( intval( $parts[1] ) ) == 1 ){
      if( is_object($foo) OR $this->ticketRepository->countByUid( intval( $parts[1] ) ) == 1 ){
			$validSteps++;
		}else{
			$this->flashMessageContainer->add('Product with sent id does not exist!');
		}

		if($validSteps == 3){
			$this->ticketId = intval( $parts[1] );
			return true;
		}else{
			return false;
		}

	}

	/*
	 * Remove single basketItem from basket
	 *
	 * @param \WX\WxLottery\Domain\Model\BasketItem $basketItem
	 * @return void
	 */
	private function deleteBasketItem($basketItemId) {
		if ( $this->basketItemRepository->countByUid ( $basketItemId ) == 1 ) {
	
			$basketItem = $this->basketItemRepository->findByUid( $basketItemId );
	
			$this->basketItemRepository->remove( $basketItem );
			//$this->flashMessageContainer->add ( 'Ticket has been removed from basket!' );
	
			// If user deleted joker from basket, store this info also to session
         if ( $basketItem->getTicket()->getUid() == $this->settings['joker']['uid'] ) {
				$this->sessionData['joker'] = 0;
				$GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $this->sessionData);
				$GLOBALS['TSFE']->storeSessionData();   
			}
	
			// workaround - or the right way?
//			$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Persistence_Manager');

//	[L:] No, this is right way ;)
			$this->persistenceManager->persistAll();
         
         // Check if last remaining ticket in basket is joker, if yes, delete id
         if( $this->basketItemRepository->countBySessionId( $this->sessionData['sessionId'] ) == 1){
            $basketItem = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
            foreach ($basketItem as $singleBasketItem) {
               if( $singleBasketItem->getTicket()->getUid() == $this->settings['joker']['uid']){
                  // If user deleted joker from basket, store this info also to session
                  $this->sessionData['joker'] = 0;
				      $GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $this->sessionData);
				      $GLOBALS['TSFE']->storeSessionData();
            
                  $this->basketItemRepository->remove( $singleBasketItem );
                  $this->persistenceManager->persistAll(); // <- save i database      
               }            	
            }
         }
		}
/*
		if ( !is_array ( $this->request->getArgument ('delete') ) ){
         $this->updateJokerInBasket();
			$this->redirect('minibasket');
		}
*/
	}

	/*
	 * Re-calculate stock & price in basket
	 *
	 * @return void
	 */
	private function recalculateBasket($amount){
      foreach ($amount as $ticketId=>$amount) {
			if($amount == 0){
				$this->deleteBasketItem($ticketId);
				continue;
			}

			if($this->basketItemRepository->countByUid( intval($ticketId) ) == 1){
	         $basketItem = $this->basketItemRepository->findByUid( intval($ticketId) );
				$basketItem->setAmount( intval( $amount ) );
	         $this->basketItemRepository->update( $basketItem );
			}
      }

		// workaround - or the right way?
//		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Persistence_Manager');
//	[L:] No, this is right way ;)
		$this->persistenceManager->persistAll(); // <- save to database
	}

	/*
	 * Calculate the sum of tickets in basket
	 *
	 * @return integer
	 */
	private function getBasketTotal($basketItems){
      foreach ($basketItems as $basketItem) {
      	$total += $basketItem->getAmount() * $basketItem->getTicket()->getCost();
      }

		return $total;
	}

	/**
	 * action minibasket
	 *
	 * @return void
	 */
	public function minibasketAction() {
      $basketItems = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
      $nrOfTickets = 0;
      $ticketsInBasket = array();
      foreach ($basketItems as $basketItem) {
         if ( $basketItem->getTicket()->getUid() == $this->settings['joker']['uid'] )
            continue;
            
      	$nrOfTickets += $basketItem->getAmount()*$basketItem->getTicket()->getNrOfTickets();
         $nrOfTens += $basketItem->getAmount()*$basketItem->getTicket()->getNrOfTens();
         $ticketsInBasket[] = $basketItem->getTicket()->getUid();
      }
      
      if( \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('ticketId') > 0 AND \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('amount') > 0 ){
         $joker = $this->ticketRepository->findByUid( $this->settings['joker']['uid'] );
         $ticket = $this->ticketRepository->findByUid( \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('ticketId') );
         $nrOfTens += in_array( \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('ticketId'), $ticketsInBasket ) ? 0 : $ticket->getNrOfTens();
         $price = $nrOfTens * \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('amount') * $joker->getCost();
         $price = $GLOBALS['TSFE']->sys_language_uid == 1 ? number_format((float) $price, 2) : $price.',-';
         die ( json_encode ( array ( 'price' => $price, 'joker' => $joker->getCost() ) ) );
      }      
      
      $this->view->assign( 'basketItems', $basketItems );
      $this->view->assign( 'highestChance', $this->getChanceOfWinning($nrOfTickets) );
      $this->view->assign( 'basketTotal', $this->getBasketTotal($basketItems) );
      $this->view->assign( 'jokerId', $this->settings['joker']['uid'] );
      $this->view->assign( 'langId', $GLOBALS['TSFE']->sys_language_uid );
      die ( json_encode ( array ( 'response' => (int) 1, 'data' => $this->view->render() ) ) );
	}
   
	private function updateBasketWithAjax(){
		$out = array();
		$out['items'] = array();
		$basketItem = $this->basketItemRepository->findByUid( intval(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('basketItemId')) );

		// validate, user is editing his own basketitem
		if($basketItem->getSessionId() != $this->sessionData['sessionId']): die(json_encode(['error'=>1, 'msg'=>'Try to access basket item which does not belongs to you'])); endif;
		// validate, can go bellow 1 amount
		if($basketItem->getAmount() == 1 AND \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('action') == 'reduce' ): die(json_encode(['error' => 1])); endif;

		if(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('action') == 'reduce') {
			$basketItem->setAmount( $basketItem->getAmount()-1 );
		} elseif(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('action') == 'add') {
			 $basketItem->setAmount( $basketItem->getAmount()+1 );
		} elseif(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('action') == 'update'){
			$newValue = (int) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('value');
			if($newValue < 1 || $newValue > 20): die(json_encode(['error' => 1])); endif;
			$basketItem->setAmount($newValue);
		} else { die(json_encode(['error' => 1, 'msg' => 'Wrong action'])); }
		$out['items'][$basketItem->getUid()]['subtotal'] = "€ ".$basketItem->getAmount()*$basketItem->getTicket()->getCost().",-";
		$out['items'][$basketItem->getUid()]['chanceOfWinning'] = $this->getChanceOfWinning( $basketItem->getAmount() );
		$this->basketItemRepository->update( $basketItem );
		// workaround - or the right way?
		//      $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Tx_Extbase_Persistence_Manager');
		//	[L:] No, right way is in construct ;)
		$this->persistenceManager->persistAll(); // <- save into database    
		$this->updateJokerInBasket();

		$nrOfTens = $this->getNrOfTens();
		$jokerBasketItem = $this->basketItemRepository->findBasketItem( $this->sessionData['sessionId'], $this->settings['joker']['uid'] );
		$jokerPrice = $this->settings['joker']['cost'][$GLOBALS['TSFE']->sys_language_uid] > 0 ? $this->settings['joker']['cost'][$GLOBALS['TSFE']->sys_language_uid]: 12;
		if($jokerBasketItem->count() > 0) {
			$jokerBasketItem = $jokerBasketItem->getFirst();
			$out['items']['joker']['subtotal'] = $nrOfTens*$jokerPrice;
			$out['items']['joker']['winPrice'] = number_format(($jokerBasketItem->getTicket()->getWinPrice()*$nrOfTens), 0, ',', '.');
		}
		$basketItems = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
		$out['total'] = $this->getBasketTotal($basketItems);
		die(json_encode($out));
	}
   
   /*
    * Calculate % chance of winning from nr. of tickets
    * 
    * @param Integer $nrOfTickets
    * @return Float
    */               
   private function getChanceOfWinning($nrOfTickets){
      if( array_key_exists( $nrOfTickets, $this->settings['chances'] ) ){
         return $this->settings['chances'][$nrOfTickets];
      }elseif( $nrOfTickets > array_pop(array_keys($this->settings['chances']))){
         return $this->settings['chances'][array_pop(array_keys($this->settings['chances']))];               
      }
      
      return false;   
   }                            
   
   private function getNrOfTens(){ 
      $nrOfTens = 0;   
      // Find all basket items
      $basketItems = $this->basketItemRepository->findBySessionId( $this->sessionData['sessionId'] );
      
      foreach ($basketItems as $basketItem) {
         if ( $basketItem->getTicket()->getUid() != $this->settings['joker']['uid'] ){
            $nrOfTens += ( $basketItem->getAmount() * $basketItem->getTicket()->getNrOfTens() );         
         }
      } 
      
      return $nrOfTens;  
   }
   
   private function debug($value){
      if($_SERVER['REMOTE_ADDR'] == '195.80.191.50'){
         if( is_array($value) ){
            print_r($value);
         }else{
            echo $value;
         }
      }
   }

}
?>