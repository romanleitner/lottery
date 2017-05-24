<?php
namespace WX\WxLottery\Controller;
use \TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Ľuboš Babocký <lb@webaholix.com>, webaholix s.r.o.
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
class LandpageController extends ActionController {

	/**
	 * ticketRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\TicketRepository
	 * @inject
	 */
	protected $ticketRepository;

	/**
	 * basketItemRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\BasketItemRepository
	 * @inject
	 */
	protected $basketItemRepository;
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$tickets = $this->ticketRepository->findTicketsForLandpageSettings();
		$this->view->assign('tickets', $tickets);
	}

	public function saveAction() {
		//[L:] Check landpage. there always must be some value!
		if(!isset($_POST['landpage']) || empty($_POST['landpage'])): die('Exactly one landpage ticket is required!'); endif;
		//[L:] Reset landpage and superklasse fields first!
		$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
			'tx_wxlottery_domain_model_ticket',
			'0=0',
			['landpage'=>0, 'superklasse'=>0]
		);
		//[L:] Set landpage ticket
		$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
			'tx_wxlottery_domain_model_ticket',
			"uid='{$_POST['landpage']}'",
			['landpage'=>1]
		);
		//[L:] Set superklasse
		if (isset($_POST['superklasse']) && !empty($_POST['superklasse'] && is_array($_POST['superklasse']))) {
			$wherePart = implode("' OR uid='", $_POST['superklasse']);
			$where = "uid='$wherePart'";
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery(
				'tx_wxlottery_domain_model_ticket',
				$where,
				['superklasse'=>1]
			);
		}
		$this->addFlashMessage('Saved');
		$this->redirect('list');
	}

	public function buttonAction() {
		$landpageTicket = $this->ticketRepository->findLandpageTicket();
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
		$jokerBasketItem = $this->basketItemRepository->findBasketItem($sessionData['sessionId'], $this->settings['joker']['uid']);
		$this->view->assign('showJoker', ($landpageTicket->getSuperklasse() && $jokerBasketItem->count() === 0) ? TRUE : FALSE);
		$this->view->assign('ticket', $landpageTicket);
	}

	public function addLandpageTicketAction() {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
		$query = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid','tx_wxlottery_domain_model_ticket','landpage=1');
		$landpageTicketId = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($query);
		if($this->basketItemRepository->findIsInBasket($sessionData['sessionId'], $landpageTicketId) !== 0) {
			$this->updateJoker(intval($this->request->getArgument('joker')));
			$this->redirectToUri('index.php?id=23');
		}
		if($this->request->hasArgument('count') && $this->request->hasArgument('joker')) {
			$query = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid','tx_wxlottery_domain_model_ticket','landpage=1');
			$landpageTicketId = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($query);
			$landpageTicket = $this->ticketRepository->findByUid($landpageTicketId);
			$basketItem = new \WX\WxLottery\Domain\Model\BasketItem;
			$basketItem->setPid( 29 );
			$basketItem->setSessionId($sessionData['sessionId']);
			$basketItem->setIpAddress($_SERVER['REMOTE_ADDR']);
			$basketItem->setUserAgent($_SERVER['HTTP_USER_AGENT']);
			$basketItem->setTime(time());
			$basketItem->setAmount(intval($this->request->getArgument('count')));
			$basketItem->setTicket($landpageTicket);
			$this->basketItemRepository->add($basketItem);
			$this->basketItemRepository->_persistAll();
		}
		$this->updateJoker(intval($this->request->getArgument('joker')));
		$this->redirectToUri('index.php?id=23');
	}

	private function updateJoker($joker) {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
		if($this->settings['joker']['uid'] > 0){
			$basketItems = $this->basketItemRepository->findBySessionId($sessionData['sessionId']);
			foreach ($basketItems as $basketItem) {
				if($this->settings['joker']['uid'] != $basketItem->getTicket()->getUid()) {
					$amount += ($basketItem->getAmount() * $basketItem->getTicket()->getNrOfTens());
				}
			}
			$jokerBasketItem = $this->basketItemRepository->findBasketItem($sessionData['sessionId'], $this->settings['joker']['uid']);
			if($jokerBasketItem->count() > 0) {
				$jokerBasketItem = $jokerBasketItem->getFirst();
				$jokerBasketItem->setAmount($amount);
				$this->basketItemRepository->update($jokerBasketItem);
			} else {
				if($joker === 1) {
					$jokerBasketItem = new \WX\WxLottery\Domain\Model\BasketItem;
					$jokerBasketItem->setPid(29);
					$jokerBasketItem->setSessionId($sessionData['sessionId']);
					$jokerBasketItem->setIpAddress($_SERVER['REMOTE_ADDR']);
					$jokerBasketItem->setUserAgent($_SERVER['HTTP_USER_AGENT']);
					$jokerBasketItem->setTime(time());
					$jokerBasketItem->setAmount($amount);
					$jokerBasketItem->setTicket($this->ticketRepository->findByUid($this->settings['joker']['uid']));
					$this->basketItemRepository->add($jokerBasketItem);
				}
			}
			$this->basketItemRepository->_persistAll();
		}
	}
}
