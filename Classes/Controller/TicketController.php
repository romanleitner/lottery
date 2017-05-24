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
class TicketController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * ticketRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\TicketRepository
	 * @inject
	 */
	protected $ticketRepository;
   
	private $sessionData;

   /**
	 * inject the session variable
	 *
	 * @return void
	 */
	public function __construct(){
		$this->sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
	}   

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
      $this->createSessionKey();
      
      if(is_array($this->sessionData) AND array_key_exists('joker', $this->sessionData) AND $this->sessionData['joker'] == 1){
         $this->view->assign('class', 'no-fancybox');
      }else{
         $this->view->assign('class', 'fancybox');
      }

		if( array_key_exists($GLOBALS["TSFE"]->id, $this->settings['category']) ){
         $tickets = $this->ticketRepository->findByCategory( $this->settings['category'][$GLOBALS['TSFE']->id] );
         
         $chances = array();
         foreach ($tickets as $ticket) {
            for ($i=1; $i<8; $i++) {
               $chances['ticket-'.$ticket->getUid()][$i] = $this->getChanceOfWinning( $i*$ticket->getNrOfTickets() );	
            }
         } 
                 
         $this->view->assign('tickets', $tickets);
			$this->view->assign('chances', $chances);
         $this->view->assign('langId', $GLOBALS['TSFE']->sys_language_uid);
		}else{
			$this->flashMessageContainer->add('Configuration problem, please contact admin');
		}

	}

   /*
	 * Create session for current user
	 *
	 * @return void
	 */
	private function createSessionKey(){
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');

		if( $sessionData == NULL ){
         $sessionData['sessionId'] = md5( time() . $_SERVER['HTTP_USER_AGENT'] );

			$GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $sessionData);
			$GLOBALS['TSFE']->storeSessionData();
		}
	}

	/**
	 * action overlay
	 *
	 * @return void
	 */
	public function overlayAction() {
		//die( $this->view->render() );
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

}
?>