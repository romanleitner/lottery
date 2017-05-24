<?php
namespace WX\WxLottery\Controller;
use WX\WxLottery\Domain\Model\Company;
use WX\WxLottery\Domain\Model\PartnerLog;
use WX\WxLottery\Domain\Model\Checkout;

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
class CheckoutController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * checkoutRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\CheckoutRepository
	 * @inject
	 */
	protected $checkoutRepository;

	/**
	 * basketItemRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\BasketItemRepository
	 * @inject
	 */
	protected $basketItemRepository;
   
   /**
	 * partnerLogRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\PartnerLogRepository
	 * @inject
	 */
	protected $partnerLogRepository;

	/**
	 * companyRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\CompanyRepository
	 * @inject
	 */
	protected $companyRepository;

	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;


	/**
	 * @var \SJBR\StaticInfoTables\Domain\Repository\CountryRepository
	 */
	protected $staticCountryRepository = NULL;
  
	/**
	 * Injects the staticCountryRepository
	 *
	 * @param \SJBR\StaticInfoTables\Domain\Repository\CountryRepository $repository repository to inject
	 *
	 * @return void
	 */
	public function injectStaticCountryRepository(\SJBR\StaticInfoTables\Domain\Repository\CountryRepository $repository) {
		$this->staticCountryRepository = $repository;
	}      

	protected $sessionData;

	/**
	 * inject the session variable
	 *
	 * @return void
	 */
	public function __construct(){
		//if($_SERVER['REMOTE_ADDR'] == '195.80.191.50'): die('error'); endif;
		$this->sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'wx_lottery');
		$this->persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
	}

	/**
	 * action new
	 *
	 * @param \WX\WxLottery\Domain\Model\Checkout $newCheckout
	 * @dontvalidate $newCheckout   
	 * @return void
	 */
	public function newAction(\WX\WxLottery\Domain\Model\Checkout $newCheckout = NULL) {
		if(!file_exists(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('wx_lottery').$this->settings['path']['publicKeyFile'])){
			$this->flashMessageContainer->add('encryption file does not exists');
			$this->view->assign('encryptionFileError', 1);
		}
		$basketCount = $this->basketItemRepository->countBySessionId($this->sessionData['sessionId']);
		$genderOptions = array(
			0=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.select_default', 'wx_lottery'),
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_2', 'wx_lottery')
		);
		if($GLOBALS['TSFE']->sys_language_uid == 1): $genderOptions[3] = \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_3', 'wx_lottery'); endif;
		$this->staticCountryRepository->setDefaultOrderings(['cnShortDe' => 'ASC']);
		$countriesRes = $this->staticCountryRepository->findAll();
		$countries = array();
		foreach ($countriesRes as $key=>$country) {  
			if(($GLOBALS['TSFE']->sys_language_uid == 0 AND $country->getIsoCodeA3() == 'AUT') OR ($GLOBALS['TSFE']->sys_language_uid == 1 AND $country->getIsoCodeA3() == 'GBR')) {
				$default = $country;
			} else {
				$countries[] = $country;
			}
		}
		if ($basketCount == 0) {
			$this->view->assign('basketEmpty', 1);
		} else {
			//Check first if user already created checkout with current session
			$checkout = $this->checkoutRepository->findBySessionId($this->sessionData['sessionId']);
			if ( $checkout->count() == 1 ) {
				$this->view->assign('newCheckout', $checkout->getFirst());
			} else {
				$this->view->assign('newCheckout', $newCheckout);
			}
		}
		$this->view->assign('genderOptions', $genderOptions);
		$this->view->assign('countryOptions', array_merge( array($default), $countries) );
		$this->view->assign('langId', $GLOBALS['TSFE']->sys_language_uid);
	}

	/**
	 * action create
	 *
	 * @param \WX\WxLottery\Domain\Model\Checkout $newCheckout
	 * @validate $newCheckout \WX\WxLottery\Validation\Validator\CheckoutValidator
	 * @return void
	 */
	public function createAction(\WX\WxLottery\Domain\Model\Checkout $newCheckout) {
		// Set new status for all basketItem in basket to "In checkout"
		$basketItems = $this->basketItemRepository->findBySessionId($this->sessionData['sessionId']);
		foreach ($basketItems as $basketItem) {
			$basketItem->setStatus(2);
			$this->basketItemRepository->update( $basketItem );
			$total += $basketItem->getAmount() * $basketItem->getTicket()->getCost();
		}

		$newCheckout->setSessionId( $this->sessionData['sessionId'] );
		$newCheckout->setBasketTotalPayment( $total );
		$newCheckout->setFinishedStep( 1 );
		$newCheckout->setCurrency( $GLOBALS['TSFE']->sys_language_uid+1 );
		$newCheckout->setPid( $this->settings['storagePid']['checkout'] );
		$newCheckout->setYear( $this->settings['lotteryYear'] );

		if( $newCheckout->getUid() > 0 ){
			$this->checkoutRepository->update($newCheckout);
		} else {
			$this->checkoutRepository->add($newCheckout);
		}

		$this->redirect('payment');
	}

	/**
	 * action payment
	 *
	 * @return void
	 */
	public function paymentAction() {
		//Check fist if user already created checkout with current session
		$checkout = $this->checkoutRepository->findBySessionId( $this->sessionData['sessionId'] );
		$ccYearValid = array('YYYY');
		for ($i=date('Y'); $i<date('Y')+17; $i++) {
			$ccYearValid[$i] = $i;
		}
		if( $checkout->count() == 1 ){
			$this->view->assign( 'ccYearValid', $ccYearValid );
			$this->view->assign( 'newCheckout', $checkout->getFirst() );
			$this->view->assign( 'langId', $GLOBALS['TSFE']->sys_language_uid);
		}
	}

	/**
	 * action overview
	 *
    * @param \WX\WxLottery\Domain\Model\Checkout $newCheckout
    * @validate $newCheckout \WX\WxLottery\Validation\Validator\PaymentValidator    
	 * @return void
	 */
	public function overviewAction(\WX\WxLottery\Domain\Model\Checkout $newCheckout) {
		$basketTotal = 0;
		$basketItems = $this->basketItemRepository->findBySessionId($this->sessionData['sessionId']);
		$nrOfPastClasses = $this->calculateNrOfPastClasses();
		$newCheckout->setFinishedStep(2);
		//CC payment
		if( $newCheckout->getPayment() == 2 OR $newCheckout->getPayment() == 3 ){
			$newCheckout->setPaymentInfo(base64_encode($this->encrypt($newCheckout)));
			//Clean up all plain text values
			$newCheckout->setDebitBankName('');
			$newCheckout->setDebitSortCode('');
			$newCheckout->setDebitAccountNr('');
			$newCheckout->setDebigAccountHolder('');
			$newCheckout->setCcHolderName('');
			$newCheckout->setCcType('');
			$newCheckout->setCcAccountNr('');
			$newCheckout->setCcExpireMonth('');
			$newCheckout->setCcExpireYear('');
			$newCheckout->setCcVerificationNr('');
		}
		//Delivery
		$newCheckout->setDeliveryPrice($newCheckout->getDelivery());
		//Payment for past classes
		$newCheckout->setPastClassPayment($nrOfPastClasses*$this->getBasketTotal($basketItems, false));
		//Payment for future classes
		if($newCheckout->getBuyAllClasses() == 2){
			$nrOfFutureClasses = $this->settings['classRounds'] - ($nrOfPastClasses + 1);
			$newCheckout->setFutureClassPayment($nrOfFutureClasses*$this->getBasketTotal($basketItems, false));
			$newCheckout->setDeliveryPrice($newCheckout->getDelivery() + ($newCheckout->getDelivery()*$nrOfFutureClasses));
		} else {
			$newCheckout->setFutureClassPayment('0.00');
		}
      
		$gender = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_2', 'wx_lottery')
		);
		$countries = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.country_1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.country_2', 'wx_lottery')
		);
		$delivery = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.postage_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.postage_option2', 'wx_lottery')
		);
		$payment = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option2', 'wx_lottery'),
			3=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option3', 'wx_lottery')
		);
		$buyAllClases = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.buyAllClesses_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.buyAllClesses_option2', 'wx_lottery')
		);
		$basketTotal = $newCheckout->getBasketTotalPayment();
		$basketTotal += $newCheckout->getPastClassPayment();
		$basketTotal += $newCheckout->getFutureClassPayment();
		$basketTotal += $newCheckout->getDeliveryPrice();
		$newCheckout->setGrandTotalPayment($basketTotal);
		$this->checkoutRepository->update($newCheckout);
		$chances = array();
		foreach ($basketItems as $basketItem) {
		   $nrOfProducts = $basketItem->getAmount()*$basketItem->getTicket()->getNrOfTickets();
		   $chances[$basketItem->getUid()] = $this->getChanceOfWinning($nrOfProducts); 
		}
		$fbPixels = "<!-- Facebook Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','//connect.facebook.net/en_US/fbevents.js');
			fbq('init', '1679244472363876');
			fbq('track', 'PageView');
			fbq('track', 'Purchase', {value: $basketTotal, currency: 'EUR'});
			</script>
			<noscript><img height='1' width='1' style='display:none' src='https://www.facebook.com/tr?id=1679244472363876&ev=PageView&noscript=1'/></noscript>
			<!-- End Facebook Pixel Code -->";
		$this->response->addAdditionalHeaderData($fbPixels);

//[L:]	This was for affilinet, not needed, was moved to other page..
/*
	$afCodeNetPrice = $basketTotal;
	$afCodeOrderId = $newCheckout->getUid();
	$affilinetCode = "<!-- [start] Affilinet Code -->
		<script>
			(function (w, d, namespace, domain, progId, tagId, undefined) {
				w[namespace] = w[namespace] || {}; var act = w[namespace], payload = [];
				act.tags = act.tags || []; act.tags.push(tagId, payload);
				var protocol = d.location.protocol;

				// Start editable part
				payload.push({
					module: 'OrderTracking',
					event: 'Sale',
					net_price: {$afCodeNetPrice},
					order_id: '{$afCodeOrderId}',
					rate_number: 1
				});
				// End editable part

				if (act.get === undefined) {
					var s = d.createElement('script');
					s.type = 'text/javascript';
					s.src = protocol + '//' + domain + '/' + 'affadvc.aspx?ns=' + namespace +
					'&dm=' + domain + '&site=' + progId + '&tag=' + tagId;
					s.async = false; // always keep false for standard tracking
					(d.getElementsByTagName('body')[0] || d.getElementsByTagName('head')[0]).appendChild(s);
				} else { act.get(w, d, progId, tagId); }
			})(window, document,
			// Start editable part
			'aff_act_1.0', 'act.webmasterplan.com', 15252, 'TAG-ID-1');
			// End editable part
		</script>
		<noscript>
		<img src='https://partners.webmasterplan.com/TrackOrder.aspx?site=15252&event=sale&net_price={$afCodeNetPrice}&order_id={$afCodeOrderId}&rate_number=1' />
		</noscript>
<!-- [end] Affilinet Code-->";
	
	$this->response->addAdditionalHeaderData($affilinetCode);
*/
		$this->view->assign('checkout', $newCheckout );
		$this->view->assign( 'chances', $chances );
		$this->view->assign('countries', $countries );
		$this->view->assign('deliveries', $delivery );
		$this->view->assign('payments', $payment );
		$this->view->assign('buyAllClasses', $buyAllClases);
		$this->view->assign('basketItems', $basketItems);
		$this->view->assign( 'jokerId', $this->settings['joker']['uid'] );
		$this->view->assign( 'langId', $GLOBALS['TSFE']->sys_language_uid );
	}

	/**
	 * action confirmOrder
	 *  
	 * @param \WX\WxLottery\Domain\Model\Checkout $checkout   
	 * @return void
	 */
	public function confirmOrderAction(\WX\WxLottery\Domain\Model\Checkout $checkout){
		$afCodeOrderId = $checkout->getUid();
		$affilinetCode = "<!-- [start] Affilinet Code --><script>
			(function (w, d, namespace, domain, progId, tagId, undefined) {
				w[namespace] = w[namespace] || {}; var act = w[namespace], payload = [];
				act.tags = act.tags || []; act.tags.push(tagId, payload);
				var protocol = d.location.protocol;
				// Start editable part
				payload.push({
					module: 'OrderTracking',
					event: 'Sale',
					net_price: {$afCodeNetPrice},
					order_id: '{$afCodeOrderId}',
					rate_number: 1
				});
				// End editable part
				if (act.get === undefined) {
					var s = d.createElement('script');
					s.type = 'text/javascript';
					s.src = protocol + '//' + domain + '/' + 'affadvc.aspx?ns=' + namespace +
					'&dm=' + domain + '&site=' + progId + '&tag=' + tagId;
					s.async = false; // always keep false for standard tracking
					(d.getElementsByTagName('body')[0] || d.getElementsByTagName('head')[0]).appendChild(s);
				} else { act.get(w, d, progId, tagId); }
				})(window, document,
				// Start editable part
				'aff_act_1.0', 'act.webmasterplan.com', 15252, 'TAG-ID-1');
				// End editable part
			</script>
			<noscript>
				<img src='https://partners.webmasterplan.com/TrackOrder.aspx?site=15252&event=sale&net_price={$afCodeNetPrice}&order_id={$afCodeOrderId}&rate_number=1' />
			</noscript>
			<!-- [end] Affilinet Code-->";

		$afCodeNetPrice = $checkout->getBasketTotalPayment();
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'WX_SESS_FOR_AFFILINET', array('test'=>$affilinetCode));
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		$this->validateSession();
		$partnerId = 1;
		if($this->request->hasArgument('orderConfirmed') && $this->request->getArgument('orderConfirmed')) {
			// Initialize partner log object
			$partnerLog = new \WX\WxLottery\Domain\Model\PartnerLog;
			$partnerLog->setPid(31);
			$partnerLog->setSessionId($this->sessionData['sessionId']);
			$basketItems = $this->basketItemRepository->findBySessionId($this->sessionData['sessionId']);

			foreach ($basketItems as $basketItem) {
				$basketItem->setStatus(3);
				$this->basketItemRepository->update($basketItem);
			}
			// Load checkout object
			//$checkout = $this->checkoutRepository->findBySessionId( $this->sessionData['sessionId'] )->getFirst();
			$checkout->setFinishedStep(3);
//[L:] New decision-making system for lottery tickets assignment
			$partner = $this->getHighestPriorityPartner();
			if($this->partnerLogRepository->findBySessionId($this->sessionData['sessionId'])): $this->sendError($partner, $checkout); endif;
			if($_SERVER['REMOTE_ADDR'] == '195.80.191.50'): $this->redirectToPage($partner->getRedirectPage()); die('debug'); endif;
			$partnerId = $partner->getUid();
			$checkout->setOrderSentTo($partner->getUid());
			$partnerLog->setPartner($partner->getUid());
//[L:END]
			$this->generateConfirmationEmail($basketItems, $checkout, $partner, true);
			$this->generateConfirmationEmail($basketItems, $checkout, $partner);
			// Add to tickets price for past classes and future clesses, if selected
			$partnerLog->setBasketTotal($checkout->getBasketTotalPayment() + $checkout->getPastClassPayment());
			$partnerLog->setGrandTotal($checkout->getGrandTotalPayment());
			$partnerLog->setCurrency($GLOBALS['TSFE']->sys_language_uid + 1);
			$partnerLog->setYear($this->settings['lotteryYear']);
			$this->partnerLogRepository->add($partnerLog);
			$this->checkoutRepository->update($checkout);
//[L:] Persist all!
			$this->persistenceManager->persistAll();
//[L:] Old	$this->redirectToPage($this->settings['redirectPid']['orderConfirmation'][$partnerId]);
			$this->redirectToPage($partner->getRedirectPage());
		}
	}

	private function sendError(Company $partner, Checkout $checkout) {
		$dt = new \DateTime();
		$message = "Error report {$dt->format("Y/m/d-H:i:s")}\n\n";
		$message .= "Record in PartnerLog with same SessionId was found and it shouldn't be duplicated!\n";
		$message .= "SessionId:\t{$this->sessionData['sessionId']}\n";
		$message .= "Checkout Id:\t{$checkout->getUid()}\n";
		$message .= "PartnerId:\t{$partner->getUid()}\n";
		mail('lb@webaholix.com', 'Klassenlos error report', $message);
		mail('bi@issi.at', 'Klassenlos error report', $message);
	}

	/**
	 * New decision-making system for lottery tickets assignment
	 * @return \WX\WxLottery\Domain\Model\Company id of company with highest priority
	 */
	private function getHighestPriorityPartner() {
		$companies = $this->companyRepository->findActiveCompanies();
		$totalBasket = 0;
		$totalWeight = 0;
		$currentYear = $this->partnerLogRepository->getHighestYear();
		/* @var $company \WX\WxLottery\Domain\Model\Company */
		foreach ($companies as $company) {
			$partnerTotal = 0;
			$orders = $this->partnerLogRepository->findByPartnerAndCurrency($company->getUid(), $GLOBALS['TSFE']->sys_language_uid+1);
			/* @var $order \WX\WxLottery\Domain\Model\PartnerLog */
			foreach ($orders as $order) {
				if($order->getYear() !== $currentYear): continue; endif;
				$partnerTotal += $order->getBasketTotal();
			}
			$partners[$company->getUid()] = ['partnerId' => $company->getUid(),	'basketTotal' => $partnerTotal,	'weight' => $company->getWeight()];
			$totalBasket += $partnerTotal;
			$totalWeight += $company->getWeight();
		}
		foreach ($partners as $partnerId => $partner) {
		//[L:] This one is important!
			$partners[$partnerId]['priority'] = ($partner['weight'] / $totalWeight) - ($partner['basketTotal'] / $totalBasket);
		}
		$winner = [];
		foreach ($partners as $partner): $winner = ($winner['priority'] < $partner['priority']) ? $partner : $winner; endforeach;
		return $this->companyRepository->findByUid($winner['partnerId']);
	}
   
   	/**
	 * action googleTracking
	 *  
	 * @return void
	 */
	public function googleTrackingAction(){
		$count = $this->checkoutRepository->countBySessionId($this->sessionData['sessionId']);
		$exchangeRate = $GLOBALS['TSFE']->sys_language_uid == 1 ? $this->settings['exchangeRate'] : 1;

		if( $count == 1) {
			$checkout = $this->checkoutRepository->findBySessionId ( $this->sessionData['sessionId'] )->getFirst();
			if( $checkout->getFinishedStep() == 3 ) {
				$partner = $this->companyRepository->findByUid($checkout->getOrderSentTo())->getUid();
			 
//[L:] Old		$partner = $checkout->getOrderSentTo() == 1 ? 'Hohe Brücke' : 'Prokopp';
				$partner .= $GLOBALS['TSFE']->sys_language_uid == 1 ? ' EN' : '';
				$this->view->assign('showAnalytics', 1);
				$this->view->assign('checkout', $checkout);
				$this->view->assign('revenue', $checkout->getBasketTotalPayment()+$checkout->getPastClassPayment()+$checkout->getFutureClassPayment());
				$this->view->assign('shipping', $checkout->getDelivery());
				$this->view->assign('basketItems', $this->basketItemRepository->findBySessionId($this->sessionData['sessionId']));
				$this->view->assign('nrOfPastClasses', $this->calculateNrOfPastClasses()+1);
				$this->view->assign('partner', $partner);
				$this->view->assign('exchangeRate', $exchangeRate);
			}
		}
		$this->setNewSessionid();
	}

	/*
	 * Generate order mail to admin
	 *
	 * @return void
	 */
	private function generateConfirmationEmail($basketItems, $checkout, \WX\WxLottery\Domain\Model\Company $partner, $admin=false){
		if( $admin === true ){
			$sentTo = $partner->getEmailAdmin();
		} else {
			$sentTo = array($checkout->getEmail() => $checkout->getFirstName().' '.$checkout->getLastName());
		}
		$country = $this->staticCountryRepository->findByUid( $checkout->getCountry() );  
		$genderArray = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.gender_2', 'wx_lottery')
		);
		$delivery = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.postage_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.postage_option2', 'wx_lottery')
		);
		$payment = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option2', 'wx_lottery'),
			3=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.payment_option3', 'wx_lottery')
		);
		$buyAllClases = array(
			1=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.buyAllClesses_option1', 'wx_lottery'),
			2=>\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_wxlottery_domain_model_checkout.checkout.buyAllClesses_option2', 'wx_lottery')
		);
		$variables = array(
			'domain' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
			'partner' => $partner,
			'country' => $country,
			'genders' => $genderArray,
			'payments' => $payment,
			'buyAllClases' => $buyAllClases,
			'deliveries' => $delivery, 
			'checkout' => $checkout,
			'basketItems' => $basketItems,
			'dateObject' => new \DateTime(),
			'jokerId' => $this->settings['joker']['uid'],
			'langId' => $GLOBALS['TSFE']->sys_language_uid,
		);
		$emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']); 
		$templatePathAndFilename = $templateRootPath . 'Email/Customer.html';
		$extensionName = $this->request->getControllerExtensionName();
		$emailView->getRequest()->setControllerExtensionName($extensionName);
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->setLayoutRootPath($layoutRootPath);
		$emailView->assignMultiple($variables);
		$emailBody = $emailView->render();
		/* @var $mail \TYPO3\CMS\Core\Mail\MailMessage */
		$mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$mail->setFrom([$partner->getEmailSender() => $partner->getEmailName()]);
		//$mail->setTo(array('lb@webaholix.com' => 'Lubos Babocky'));
		$mail->setTo($sentTo);
		if($admin === TRUE): foreach ($this->companyRepository->getAllEmails() as $adminMail) { if($sentTo != $adminMail): $mail->addBcc($adminMail); endif; } endif;
		//$mail->addBcc('lb@webaholix.com');
		$mail->setSubject( \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('email.subject', 'wx_lottery') );
		$mail->setBody($emailBody, 'text/html');

		if($admin === TRUE AND $checkout->getPayment() != 1 ){
			$fp = fopen("uploads/tx_wxlottery/paymentInfo_{$checkout->getUid()}.txt", 'w');
			fwrite($fp, $checkout->getPaymentInfo());
			fclose($fp);
			$attachment = \Swift_Attachment::fromPath("uploads/tx_wxlottery/paymentInfo_{$checkout->getUid()}.txt");
			$attachment->setFilename('paymentInfo.txt');
			$mail->attach($attachment);
		}
		$mail->send();
		//unlink("uploads/tx_wxlottery/paymentInfo_{$checkout->getUid()}.txt");
	}

   /*
	 * Create session for current user
	 *
	 * @return void
	 */
	private function setNewSessionid(){
		$this->sessionData['sessionId'] = md5(time().$_SERVER['HTTP_USER_AGENT']);
		$this->sessionData['joker'] = 0;
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'wx_lottery', $this->sessionData);
		$GLOBALS['TSFE']->storeSessionData();
	}

	/*
	 * Calculate the sum of tickets in basket
	 * @return integer
	 */
	private function getBasketTotal($basketItems) {
		foreach ($basketItems as $basketItem) {
			if( $basketItem->getTicket()->getUid() == $this->settings['joker']['uid'] ): continue; endif;
			$total += $basketItem->getAmount() * $basketItem->getTicket()->getCost();
		}
		return $total;
	}

	/*
	 * Encrypt CC number with public openSSL key
	 * 
	 * @param \WX\WxLottery\Domain\Model\Checkout $newCheckout
	 * @return string encrypted CC nr.
	 */            
	private function encrypt($newCheckout) {
		$filename = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('wx_lottery') . $this->settings['path']['publicKeyFile'];
		$handle = fopen($filename, "r");
		$public = fread($handle, filesize($filename));
		fclose($handle);
		$paymentInfo = array();
		if( $newCheckout->getPayment() == 2 ) {
			$paymentInfo['Name der Bank'] = $newCheckout->getDebitBankName();
			$paymentInfo['BIC'] = $newCheckout->getDebitSortCode();
			$paymentInfo['IBAN'] = $newCheckout->getDebitAccountNr();
			$paymentInfo['Karteninhaber'] = $newCheckout->getDebigAccountHolder();
		}
		if( $newCheckout->getPayment() == 3 ){
			$paymentInfo['Karteninhaber'] = $newCheckout->getCcHolderName();
			$paymentInfo['Kreditkarte'] = $newCheckout->getCcType() == 1 ? 'Mastercard' : 'Visa';
			$paymentInfo['Kartennummer'] = $newCheckout->getCcAccountNr();
			$paymentInfo['Gültig bis (Monat)'] = $newCheckout->getCcExpireMonth();
			$paymentInfo['Gültig bis (Jahr)'] = $newCheckout->getCcExpireYear();
			$paymentInfo['Prüfziffer'] = $newCheckout->getCcVerificationNr();
		}      
		$plainString = json_encode($paymentInfo);
		if(!$publicKey = openssl_pkey_get_public($public)): die('Loading Public Key failed'); endif;
		//if (!openssl_public_encrypt($plainString, $encrypted, $publicKey))    die('Failed to encrypt data');
		return $this->ssl_encrypt($plainString, 'public', $publicKey);
	}
   
	private function ssl_encrypt($source,$type,$key){
		//Assumes 1024 bit key and encrypts in chunks.
		$maxlength=117;
		$output='';
		while($source) {
			$input= substr($source,0,$maxlength);
			$source=substr($source,$maxlength);
			if($type=='private') {
				$ok= openssl_private_encrypt($input,$encrypted,$key);
			} else {
				$ok= openssl_public_encrypt($input,$encrypted,$key);
			}
			$output.=$encrypted;
		}
		return $output;
	}

	private function ssl_decrypt($source,$type,$key) {
		$maxlength=128;
		$output='';
		while($source) {
			$input= substr($source,0,$maxlength);
			$source=substr($source,$maxlength);
			if($type=='private') {
				$ok = openssl_private_decrypt($input,$out,$key);
			} else {
				$ok= openssl_public_decrypt($input,$out,$key);
			}
			$output.=$out;
		}
		return $output;
	} 
   
	private function validateSession() {
		if( !is_array($this->sessionData)): $this->redirectToPage( $this->settings['redirectPid']['basket'] ); endif;
		if( !array_key_exists('sessionId', $this->sessionData) ): $this->redirectToPage( $this->settings['redirectPid']['basket'] ); endif;
		if( $this->basketItemRepository->countBySessionId($this->sessionData['sessionId'] ) == 0): $this->redirectToPage( $this->settings['redirectPid']['basket'] ); endif;
	}

	private function redirectToPage($pageId=23) {
		$uri = $this->uriBuilder->setTargetPageUid($pageId)->build();
		$this->redirectToURI($uri);
	}
   
   /*
    * Calculate nr. of classes which have been drown already
    * @return Integer 
    */
   private function calculateNrOfPastClasses(){
      if( is_array($this->settings['classes']) ){
         $nrOfPastClasses = 0;
         foreach($this->settings['classes'] as $date) {
            //Validate date
            if($date != date('j.n.Y', strtotime($date)))
               continue;
               
            // +432000 means 12hours
            //echo time() . ' : ' . (strtotime($date)+43200).'<br />';
            if( time() > (strtotime($date)+61200) )
               $nrOfPastClasses++;                     	
         }
      }else{
         $nrOfPastClasses = 0;
      }
      return $nrOfPastClasses;
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
