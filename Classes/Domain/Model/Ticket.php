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
class Ticket extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * Description
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Category
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $category;

	/**
	 * Icon
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $icon;

	/**
	 * Winning price
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $winPrice;

	/**
	 * Ticket price
	 *
	 * @var \float
	 */
	protected $cost;

	/**
	 * Chances to win [%]
	 *
	 * @var \float
	 */
	protected $chances;

	/**
	 * Money back guarantee
	 *
	 * @var \boolean
	 */
	protected $moneyBack = FALSE;

	/**
	 * Nr. of tickets included
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $nrOfTickets;
   
   /**
	 * Nr. of 10s
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $nrOfTens;

   /**
	 * Show on Landpage
	 *
	 * @var \boolean
	 * @validate NotEmpty
	 */
	protected $landpage;

	/**
	 * Add superklasse
	 *
	 * @var \boolean
	 * @validate NotEmpty
	 */
	protected $superklasse;

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the category
	 *
	 * @return \integer $category
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \integer $category
	 * @return void
	 */
	public function setCategory($category) {
		$this->category = $category;
	}

	/**
	 * Returns the icon
	 *
	 * @return \string $icon
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Sets the icon
	 *
	 * @param \string $icon
	 * @return void
	 */
	public function setIcon($icon) {
		$this->icon = $icon;
	}

	/**
	 * Returns the winPrice
	 *
	 * @return \integer $winPrice
	 */
	public function getWinPrice() {
		return $this->winPrice;
	}

	/**
	 * Sets the winPrice
	 *
	 * @param \integer $winPrice
	 * @return void
	 */
	public function setWinPrice($winPrice) {
		$this->winPrice = $winPrice;
	}

	/**
	 * Returns the cost
	 *
	 * @return \float $cost
	 */
	public function getCost() {
		return $this->cost;
	}

	/**
	 * Sets the cost
	 *
	 * @param \float $cost
	 * @return void
	 */
	public function setCost($cost) {
		$this->cost = $cost;
	}

	/**
	 * Returns the chances
	 *
	 * @return \float $chances
	 */
	public function getChances() {
		return $this->chances;
	}

	/**
	 * Sets the chances
	 *
	 * @param \float $chances
	 * @return void
	 */
	public function setChances($chances) {
		$this->chances = $chances;
	}

	/**
	 * Returns the moneyBack
	 *
	 * @return boolean $moneyBack
	 */
	public function getMoneyBack() {
		return $this->moneyBack;
	}

	/**
	 * Sets the moneyBack
	 *
	 * @param boolean $moneyBack
	 * @return void
	 */
	public function setMoneyBack($moneyBack) {
		$this->moneyBack = $moneyBack;
	}

	/**
	 * Returns the boolean state of moneyBack
	 *
	 * @return boolean
	 */
	public function isMoneyBack() {
		return $this->getMoneyBack();
	}

	/**
	 * Returns the nrOfTickets
	 *
	 * @return \integer $nrOfTickets
	 */
	public function getNrOfTickets() {
		return $this->nrOfTickets;
	}

	/**
	 * Sets the nrOfTickets
	 *
	 * @param \integer $nrOfTickets
	 * @return void
	 */
	public function setNrOfTickets($nrOfTickets) {
		$this->nrOfTickets = $nrOfTickets;
	}
   
   /**
	 * Returns the nrOfTens
	 *
	 * @return \integer $nrOfTens
	 */
	public function getNrOfTens() {
		return $this->nrOfTens;
	}

	/**
	 * Sets the nrOfTens
	 *
	 * @param \integer $nrOfTens
	 * @return void
	 */
	public function setNrOfTens($nrOfTens) {
		$this->nrOfTens = $nrOfTens;
	}
   
   /**
	 * Returns the landpage
	 *
	 * @return \boolean $landpage
	 */
	public function getLandpage() {
		return $this->landpage;
	}

	/**
	 * Sets the landpage
	 *
	 * @param \boolean $landpage
	 * @return void
	 */
	public function setLandpage($landpage) {
		$this->landpage = $landpage;
	}
   
   /**
	 * Returns the superklasse
	 *
	 * @return \boolean $superklasse
	 */
	public function getSuperklasse() {
		return $this->superklasse;
	}

	/**
	 * Sets the superklasse
	 *
	 * @param \boolean $superklasse
	 * @return void
	 */
	public function setSuperklasse($superklasse) {
		$this->superklasse = $superklasse;
	}

}
?>