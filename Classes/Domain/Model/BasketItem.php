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
class BasketItem extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Session ID
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $sessionId;

	/**
	 * HTTP user agent
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $userAgent;

	/**
	 * Time
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $time;

	/**
	 * Amount
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $amount;

	/**
	 * IP address
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $ipAddress;

	/**
	 * Status
	 *
	 * @var \integer
	 */
	protected $status;

	/**
	 * ticket
	 *
	 * @var \WX\WxLottery\Domain\Model\Ticket
	 */
	protected $ticket;

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
	 * Returns the userAgent
	 *
	 * @return \string $userAgent
	 */
	public function getUserAgent() {
		return $this->userAgent;
	}

	/**
	 * Sets the userAgent
	 *
	 * @param \string $userAgent
	 * @return void
	 */
	public function setUserAgent($userAgent) {
		$this->userAgent = $userAgent;
	}

	/**
	 * Returns the time
	 *
	 * @return \DateTime $time
	 */
	public function getTime() {
		return $this->time;
	}

	/**
	 * Sets the time
	 *
	 * @param \DateTime $time
	 * @return void
	 */
	public function setTime($time) {
		$this->time = $time;
	}

	/**
	 * Returns the amount
	 *
	 * @return \integer $amount
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Sets the amount
	 *
	 * @param \integer $amount
	 * @return void
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}

	/**
	 * Returns the ipAddress
	 *
	 * @return \string $ipAddress
	 */
	public function getIpAddress() {
		return $this->ipAddress;
	}

	/**
	 * Sets the ipAddress
	 *
	 * @param \string $ipAddress
	 * @return void
	 */
	public function setIpAddress($ipAddress) {
		$this->ipAddress = $ipAddress;
	}

	/**
	 * Returns the status
	 *
	 * @return \integer $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param \integer $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Returns the ticket
	 *
	 * @return \WX\WxLottery\Domain\Model\Ticket $ticket
	 */
	public function getTicket() {
		return $this->ticket;
	}

	/**
	 * Sets the ticket
	 *
	 * @param \WX\WxLottery\Domain\Model\Ticket $ticket
	 * @return void
	 */
	public function setTicket(\WX\WxLottery\Domain\Model\Ticket $ticket) {
		$this->ticket = $ticket;
	}

}
?>