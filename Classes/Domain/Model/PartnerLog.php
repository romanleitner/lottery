<?php
namespace WX\WxLottery\Domain\Model;

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
class PartnerLog extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Partner
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $partner;

	/**
	 * BasketTotal
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $basketTotal;
   
   /**
	 * GrandTotal
	 *
	 * @var \float
	 * @validate NotEmpty
	 */
	protected $grandTotal;
   
	/**
	 * Currency:
	 *
	 * @var \integer
	 */
	protected $currency;     

	/**
	 * Session ID
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $sessionId;

	/**
	 * Year
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $year;

	/**
	 * Returns the partner
	 *
	 * @return \integer $partner
	 */
	public function getPartner() {
		return $this->partner;
	}

	/**
	 * Sets the partner
	 *
	 * @param \integer $partner
	 * @return void
	 */
	public function setPartner($partner) {
		$this->partner = $partner;
	}

	/**
	 * Returns the basketTotal
	 *
	 * @return \integer $basketTotal
	 */
	public function getBasketTotal() {
		return $this->basketTotal;
	}

	/**
	 * Sets the basketTotal
	 *
	 * @param \integer $basketTotal
	 * @return void
	 */
	public function setBasketTotal($basketTotal) {
		$this->basketTotal = $basketTotal;
	}
   
	/**
	 * Returns the grandTotal
	 *
	 * @return \integer $grandTotal
	 */
	public function getGrandTotal() {
		return $this->grandTotal;
	}

	/**
	 * Sets the grandTotal
	 *
	 * @param \integer $grandTotal
	 * @return void
	 */
	public function setGrandTotal($grandTotal) {
		$this->grandTotal = $grandTotal;
	}  
   
	/**
	 * Returns the currency
	 *
	 * @return \integer $currency
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * Sets the currency
	 *
	 * @param \integer $currency
	 * @return void
	 */
	public function setCurrency($currency) {
		$this->currency = $currency;
	}    

	/**
	 * Returns the sessionId
	 *
	 * @return \string $sessionId
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * Sets the sessionId
	 *
	 * @param \string $sessionId
	 * @return void
	 */
	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
	}

	/**
	 * Returns the year
	 *
	 * @return \integer $year
	 */
	public function getYear() {
		return $this->year;
	}

	/**
	 * Sets the year
	 *
	 * @param \integer $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}

}
?>