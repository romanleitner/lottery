<?php
namespace WX\WxLottery\Domain\Model;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

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
class Company extends AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name = '';

	/**
	 * emailSender
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $emailSender = '';

	/**
	 * emailName
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $emailName = '';

	/**
	 * emailAdmin
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $emailAdmin = '';

	/**
	 * weight
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $weight = 0.0;

	/**
	 * redirectPage
	 * 
	 * @var int
	 */
	protected $redirectPage = 0;

	/**
	 * redirectPage
	 * 
	 * @var string
	 */
	protected $info = '';

	/**
	 * redirectPage
	 * 
	 * @var string
	 */
	protected $logo = '';

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the emailSender
	 *
	 * @return string $emailSender
	 */
	public function getEmailSender() {
		return $this->emailSender;
	}

	/**
	 * Sets the emailSender
	 *
	 * @param string $emailSender
	 * @return void
	 */
	public function setEmailSender($emailSender) {
		$this->emailSender = $emailSender;
	}

	/**
	 * Returns the emailName
	 *
	 * @return string $emailName
	 */
	public function getEmailName() {
		return $this->emailName;
	}

	/**
	 * Sets the emailName
	 *
	 * @param string $emailName
	 * @return void
	 */
	public function setEmailName($emailName) {
		$this->emailName = $emailName;
	}

	/**
	 * Returns the emailAdmin
	 *
	 * @return string $emailAdmin
	 */
	public function getEmailAdmin() {
		return $this->emailAdmin;
	}

	/**
	 * Sets the emailAdmin
	 *
	 * @param string $emailAdmin
	 * @return void
	 */
	public function setEmailAdmin($emailAdmin) {
		$this->emailAdmin = $emailAdmin;
	}

	/**
	 * Returns the weight
	 *
	 * @return float $weight
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * Sets the weight
	 *
	 * @param float $weight
	 * @return void
	 */
	public function setWeight($weight) {
		$this->weight = $weight;
	}

	/**
	 * Returns the redirectPage
	 *
	 * @return int $redirectPage
	 */
	public function getRedirectPage() {
		return $this->redirectPage;
	}

	/**
	 * Sets the redirectPage
	 *
	 * @param int $redirectPage
	 * @return void
	 */
	public function setRedirectPage($redirectPage) {
		$this->redirectPage = $redirectPage;
	}

	/**
	 * Returns the info
	 *
	 * @return string $info
	 */
	public function getInfo() {
		return $this->info;
	}

	/**
	 * Sets the info
	 *
	 * @param string $info
	 * @return void
	 */
	public function setInfo($info) {
		$this->info = $info;
	}

	/**
	 * Returns the logo
	 *
	 * @return string $logo
	 */
	public function getLogo() {
		return $this->logo;
	}

	/**
	 * Sets the logo
	 *
	 * @param string $logo
	 * @return void
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
	}
}
