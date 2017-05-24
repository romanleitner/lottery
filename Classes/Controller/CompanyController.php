<?php
namespace WX\WxLottery\Controller;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use WX\WxLottery\Domain\Model\Company;

use TYPO3\CMS\Core\Messaging\FlashMessage;
//use WX\WxLottery\Domain\Model\PartnerLog;

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
class CompanyController extends ActionController {

	/**
	 * companyRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\CompanyRepository
	 * @inject
	 */
	protected $companyRepository;

   /**
	 * partnerLogRepository
	 *
	 * @var \WX\WxLottery\Domain\Repository\PartnerLogRepository
	 * @inject
	 */
	protected $partnerLogRepository;

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
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$report = [];
		$total = [];
		/* @var $partnerLog \WX\WxLottery\Domain\Model\PartnerLog */
		foreach ($this->partnerLogRepository->findAll() as $partnerLog) {
			if($partnerLog->getCurrency() != 1): continue; endif;
			/* @var $company \WX\WxLottery\Domain\Model\Company */
			$company = $this->companyRepository->findByUid($partnerLog->getPartner());
			if(!isset($company)): continue; endif;
			//[L:] Structure: $report[year][company][currency][data]
			$totalOrders[$partnerLog->getYear()] += 1; 
			$report[$partnerLog->getYear()][$company->getName()]['counter'] += 1;
			$report[$partnerLog->getYear()][$company->getName()]['basket'] += $partnerLog->getBasketTotal();
			$report[$partnerLog->getYear()][$company->getName()]['grand'] += $partnerLog->getGrandTotal();
			$total[$partnerLog->getYear()]['basket'] += $partnerLog->getBasketTotal();
			$total[$partnerLog->getYear()]['grand'] += $partnerLog->getGrandTotal();
		}
		krsort($report);
		
		foreach ($report as $year => $companyData) {
			foreach ($companyData as $company => $data) {
				$report[$year][$company]['basketPercentage'] = 100 * $report[$year][$company]['basket'] / $total[$year]['basket'];
				$report[$year][$company]['grandPercentage'] = 100 * $report[$year][$company]['grand'] / $total[$year]['grand'];
			}
		}

		$this->view->assign('nextCompany', $this->getHighestPriorityPartner());
		$this->view->assign('totalOrders', $totalOrders);
		$this->view->assign('reports', $report);
		$this->view->assign('companies', $this->companyRepository->findActiveCompanies());
	}

	/**
	 * action create
	 * 
	 * @return void
	 */
	public function createAction(Company $newCompany) {
		$this->companyRepository->add($newCompany);
//		$this->companyRepository->_persistAll();

		$this->redirect('list');
	}

	public function updateAction(Company $company) {
		$this->companyRepository->update($company);
		$this->redirect('list');
	}

	public function deleteAction(Company $company) {
		$this->companyRepository->remove($company);
		$this->addFlashMessage('Company was deleted');
		$this->redirect('list');
	}

	public function deleteOrderAction() {
/*[L!]*/echo '<pre>';
		if($this->request->hasArgument('orderId')) {
			/* @var $checkout \WX\WxLottery\Domain\Model\Checkout */
			$checkout = $this->checkoutRepository->findByUid($this->request->getArgument('orderId'));
			if(!isset($checkout)): $this->addFlashMessage('Error: order not found.'); $this->redirect('list'); endif;
			/* @var $partnerLog \WX\WxLottery\Domain\Model\PartnerLog */
			$partnerLog = $this->partnerLogRepository->findBySessionId($checkout->getSessionId());
			if(isset($partnerLog)): $this->partnerLogRepository->remove($partnerLog); endif;
			/* @var $basketItem \WX\WxLottery\Domain\Model\BasketItem */
			$basketItems = $this->basketItemRepository->findBySessionId($checkout->getSessionId());
			foreach($basketItems as $basketItem) { $this->basketItemRepository->remove($basketItem); }
			$this->checkoutRepository->remove($checkout);
			$this->addFlashMessage("Order {$this->request->getArgument('orderId')} has been deleted");
		} else {
			$this->addFlashMessage('No order ID to delete');
		}
		$this->redirect('list');
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
			$orders = $this->partnerLogRepository->findByPartnerAndCurrency($company->getUid(), 1);
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
//[L:] Next 2 rows are not needed! They are just for testing!
//				$partners[$partnerId]['claimWeight'] = $partner['weight'] / $totalWeight;
//				$partners[$partnerId]['currentPart'] = $partner['basketTotal'] / $totalBasket;
//[L:] This one is important!
			$partners[$partnerId]['priority'] = ($partner['weight'] / $totalWeight) - ($partner['basketTotal'] / $totalBasket);
		}
		$winner = [];
		foreach ($partners as $partner) { $winner = ($winner['priority'] < $partner['priority']) ? $partner : $winner; }
	//	if(!isset($winner['partnerId'])): die('Error! No winner..'); endif;
		return $this->companyRepository->findByUid($winner['partnerId']);
	}
}