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
class Checkout extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Last name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $lastName;

	/**
	 * First name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $firstName;

	/**
	 * Gender
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $gender;

	/**
	 * Country
	 *
	 * @var \integer
	 * @validate NotEmpty
	 */
	protected $country;

	/**
	 * ZIP
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $zip;

	/**
	 * City
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $city;

	/**
	 * Address
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $address;

	/**
	 * Email
	 *
	 * @var \string
	 * @validate NotEmpty, EmailAddress
	 */
	protected $email;

	/**
	 * Session ID
	 *
	 * @var \string
	 */
	protected $sessionId;

	/**
	 * Gender - delivery
	 *
	 * @var \integer
	 */
	protected $dGender;

	/**
	 * First name - delivery
	 *
	 * @var \string
	 */
	protected $dFirstName;

	/**
	 * Last name - delivery
	 *
	 * @var \string
	 */
	protected $dLastName;

	/**
	 * Country - delivery
	 *
	 * @var \integer
	 */
	protected $dCountry;

	/**
	 * Zip - delivery
	 *
	 * @var \string
	 */
	protected $dZip;

	/**
	 * City - delivery
	 *
	 * @var \string
	 */
	protected $dCity;

	/**
	 * Address - delivery
	 *
	 * @var \string
	 */
	protected $dAddress;

	/**
	 * Email - delivery
	 *
	 * @var \string
	 */
	protected $dEmail;

	/**
	 * Finished spet
	 *
	 * @var \integer
	 */
	protected $finishedStep;

	/**
	 * Delivery type
	 *
	 * @var \integer
	 */
	protected $delivery;

	/**
	 * Payment type
	 *
	 * @var \integer
	 */
	protected $payment;

	/**
	 * Buy all classes
	 *
	 * @var \integer
	 */
	protected $buyAllClasses;

	/**
	 * debit - Bank name
	 *
	 * @var \string
	 */
	protected $debitBankName;

	/**
	 * Email - Bank sort code
	 *
	 * @var \string
	 */
	protected $debitSortCode;

	/**
	 * debit - Account nr.
	 *
	 * @var \string
	 */
	protected $debitAccountNr;

	/**
	 * debit - Account holder
	 *
	 * @var \string
	 */
	protected $debigAccountHolder;

	/**
	 * cc - Holder name
	 *
	 * @var \string
	 */
	protected $ccHolderName;

	/**
	 * cc - Card type
	 *
	 * @var \string
	 */
	protected $ccType;

	/**
	 * cc - Account Nr.
	 *
	 * @var \string
	 */
	protected $ccAccountNr;

	/**
	 * cc - Expire month
	 *
	 * @var \integer
	 */
	protected $ccExpireMonth;

	/**
	 * cc - Expire year
	 *
	 * @var \integer
	 */
	protected $ccExpireYear;

	/**
	 * cc - Verification Nr.
	 *
	 * @var \integer
	 */
	protected $ccVerificationNr;

	/**
	 * Encrypted payment info
	 *
	 * @var \string
	 */
	protected $paymentInfo;

	/**
	 * Order sent to partner:
	 *
	 * @var \integer
	 */
	protected $orderSentTo;
   
	/**
	 * Currency:
	 *
	 * @var \integer
	 */
	protected $currency;   

	/**
	 * Price for products in basket
	 *
	 * @var \float
	 */
	protected $basketTotalPayment;

	/**
	 * Price for past classes
	 *
	 * @var \float
	 */
	protected $pastClassPayment;

	/**
	 * Price for future classes
	 *
	 * @var \float
	 */
	protected $futureClassPayment;
   
	/**
	 * Delivery price
	 *
	 * @var \integer
	 */
	protected $deliveryPrice;
   
	/**
	 * Final price to pay, including delivery
	 *
	 * @var \float
	 */
	protected $grandTotalPayment;   
   
	/**
	 * Encrypted comment
	 *
	 * @var \string
	 */
	protected $comment;

	/**
	 * Year
	 *
	 * @var \integer
	 */
	protected $year;

	/**
	 * Returns the lastName
	 *
	 * @return \string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param \string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the firstName
	 *
	 * @return \string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param \string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the gender
	 *
	 * @return \integer $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param \integer $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the country
	 *
	 * @return \integer $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \integer $country
	 * @return void
	 */
	public function setCountry($country) {
		$this->country = $country;
	}

	/**
	 * Returns the zip
	 *
	 * @return \string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param \string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return \string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param \string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the address
	 *
	 * @return \string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \string $address
	 * @return void
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * Returns the email
	 *
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
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
	 * Returns the dGender
	 *
	 * @return \integer $dGender
	 */
	public function getDGender() {
		return $this->dGender;
	}

	/**
	 * Sets the dGender
	 *
	 * @param \integer $dGender
	 * @return void
	 */
	public function setDGender($dGender) {
		$this->dGender = $dGender;
	}

	/**
	 * Returns the dFirstName
	 *
	 * @return \string $dFirstName
	 */
	public function getDFirstName() {
		return $this->dFirstName;
	}

	/**
	 * Sets the dFirstName
	 *
	 * @param \string $dFirstName
	 * @return void
	 */
	public function setDFirstName($dFirstName) {
		$this->dFirstName = $dFirstName;
	}

	/**
	 * Returns the dLastName
	 *
	 * @return \string $dLastName
	 */
	public function getDLastName() {
		return $this->dLastName;
	}

	/**
	 * Sets the dLastName
	 *
	 * @param \string $dLastName
	 * @return void
	 */
	public function setDLastName($dLastName) {
		$this->dLastName = $dLastName;
	}

	/**
	 * Returns the dCountry
	 *
	 * @return \integer $dCountry
	 */
	public function getDCountry() {
		return $this->dCountry;
	}

	/**
	 * Sets the dCountry
	 *
	 * @param \integer $dCountry
	 * @return void
	 */
	public function setDCountry($dCountry) {
		$this->dCountry = $dCountry;
	}

	/**
	 * Returns the dZip
	 *
	 * @return \string $dZip
	 */
	public function getDZip() {
		return $this->dZip;
	}

	/**
	 * Sets the dZip
	 *
	 * @param \string $dZip
	 * @return void
	 */
	public function setDZip($dZip) {
		$this->dZip = $dZip;
	}

	/**
	 * Returns the dCity
	 *
	 * @return \string $dCity
	 */
	public function getDCity() {
		return $this->dCity;
	}

	/**
	 * Sets the dCity
	 *
	 * @param \string $dCity
	 * @return void
	 */
	public function setDCity($dCity) {
		$this->dCity = $dCity;
	}

	/**
	 * Returns the dAddress
	 *
	 * @return \string $dAddress
	 */
	public function getDAddress() {
		return $this->dAddress;
	}

	/**
	 * Sets the dAddress
	 *
	 * @param \string $dAddress
	 * @return void
	 */
	public function setDAddress($dAddress) {
		$this->dAddress = $dAddress;
	}

	/**
	 * Returns the dEmail
	 *
	 * @return \string $dEmail
	 */
	public function getDEmail() {
		return $this->dEmail;
	}

	/**
	 * Sets the dEmail
	 *
	 * @param \string $dEmail
	 * @return void
	 */
	public function setDEmail($dEmail) {
		$this->dEmail = $dEmail;
	}

	/**
	 * Returns the finishedStep
	 *
	 * @return \integer $finishedStep
	 */
	public function getFinishedStep() {
		return $this->finishedStep;
	}

	/**
	 * Sets the finishedStep
	 *
	 * @param \integer $finishedStep
	 * @return void
	 */
	public function setFinishedStep($finishedStep) {
		$this->finishedStep = $finishedStep;
	}

	/**
	 * Returns the delivery
	 *
	 * @return \integer $delivery
	 */
	public function getDelivery() {
		return $this->delivery;
	}

	/**
	 * Sets the delivery
	 *
	 * @param \integer $delivery
	 * @return void
	 */
	public function setDelivery($delivery) {
		$this->delivery = $delivery;
	}

	/**
	 * Returns the payment
	 *
	 * @return \integer $payment
	 */
	public function getPayment() {
		return $this->payment;
	}

	/**
	 * Sets the payment
	 *
	 * @param \integer $payment
	 * @return void
	 */
	public function setPayment($payment) {
		$this->payment = $payment;
	}

	/**
	 * Returns the buyAllClasses
	 *
	 * @return \integer $buyAllClasses
	 */
	public function getBuyAllClasses() {
		return $this->buyAllClasses;
	}

	/**
	 * Sets the buyAllClasses
	 *
	 * @param \integer $buyAllClasses
	 * @return void
	 */
	public function setBuyAllClasses($buyAllClasses) {
		$this->buyAllClasses = $buyAllClasses;
	}

	/**
	 * Returns the debitBankName
	 *
	 * @return \string $debitBankName
	 */
	public function getDebitBankName() {
		return $this->debitBankName;
	}

	/**
	 * Sets the debitBankName
	 *
	 * @param \string $debitBankName
	 * @return void
	 */
	public function setDebitBankName($debitBankName) {
		$this->debitBankName = $debitBankName;
	}

	/**
	 * Returns the debitSortCode
	 *
	 * @return \string $debitSortCode
	 */
	public function getDebitSortCode() {
		return $this->debitSortCode;
	}

	/**
	 * Sets the debitSortCode
	 *
	 * @param \string $debitSortCode
	 * @return void
	 */
	public function setDebitSortCode($debitSortCode) {
		$this->debitSortCode = $debitSortCode;
	}

	/**
	 * Returns the debitAccountNr
	 *
	 * @return \string $debitAccountNr
	 */
	public function getDebitAccountNr() {
		return $this->debitAccountNr;
	}

	/**
	 * Sets the debitAccountNr
	 *
	 * @param \string $debitAccountNr
	 * @return void
	 */
	public function setDebitAccountNr($debitAccountNr) {
		$this->debitAccountNr = $debitAccountNr;
	}

	/**
	 * Returns the debigAccountHolder
	 *
	 * @return \string $debigAccountHolder
	 */
	public function getDebigAccountHolder() {
		return $this->debigAccountHolder;
	}

	/**
	 * Sets the debigAccountHolder
	 *
	 * @param \string $debigAccountHolder
	 * @return void
	 */
	public function setDebigAccountHolder($debigAccountHolder) {
		$this->debigAccountHolder = $debigAccountHolder;
	}

	/**
	 * Returns the ccHolderName
	 *
	 * @return \string $ccHolderName
	 */
	public function getCcHolderName() {
		return $this->ccHolderName;
	}

	/**
	 * Sets the ccHolderName
	 *
	 * @param \string $ccHolderName
	 * @return void
	 */
	public function setCcHolderName($ccHolderName) {
		$this->ccHolderName = $ccHolderName;
	}

	/**
	 * Returns the ccType
	 *
	 * @return \string $ccType
	 */
	public function getCcType() {
		return $this->ccType;
	}

	/**
	 * Sets the ccType
	 *
	 * @param \string $ccType
	 * @return void
	 */
	public function setCcType($ccType) {
		$this->ccType = $ccType;
	}

	/**
	 * Returns the ccAccountNr
	 *
	 * @return \string $ccAccountNr
	 */
	public function getCcAccountNr() {
		return $this->ccAccountNr;
	}

	/**
	 * Sets the ccAccountNr
	 *
	 * @param \string $ccAccountNr
	 * @return void
	 */
	public function setCcAccountNr($ccAccountNr) {
		$this->ccAccountNr = $ccAccountNr;
	}

	/**
	 * Returns the ccExpireMonth
	 *
	 * @return \integer $ccExpireMonth
	 */
	public function getCcExpireMonth() {
		return $this->ccExpireMonth;
	}

	/**
	 * Sets the ccExpireMonth
	 *
	 * @param \integer $ccExpireMonth
	 * @return void
	 */
	public function setCcExpireMonth($ccExpireMonth) {
		$this->ccExpireMonth = $ccExpireMonth;
	}

	/**
	 * Returns the ccExpireYear
	 *
	 * @return \integer $ccExpireYear
	 */
	public function getCcExpireYear() {
		return $this->ccExpireYear;
	}

	/**
	 * Sets the ccExpireYear
	 *
	 * @param \integer $ccExpireYear
	 * @return void
	 */
	public function setCcExpireYear($ccExpireYear) {
		$this->ccExpireYear = $ccExpireYear;
	}

	/**
	 * Returns the ccVerificationNr
	 *
	 * @return \integer $ccVerificationNr
	 */
	public function getCcVerificationNr() {
		return $this->ccVerificationNr;
	}

	/**
	 * Sets the ccVerificationNr
	 *
	 * @param \integer $ccVerificationNr
	 * @return void
	 */
	public function setCcVerificationNr($ccVerificationNr) {
		$this->ccVerificationNr = $ccVerificationNr;
	}

	/**
	 * Returns the paymentInfo
	 *
	 * @return \string $paymentInfo
	 */
	public function getPaymentInfo() {
		return $this->paymentInfo;
	}

	/**
	 * Sets the paymentInfo
	 *
	 * @param \string $paymentInfo
	 * @return void
	 */
	public function setPaymentInfo($paymentInfo) {
		$this->paymentInfo = $paymentInfo;
	}

	/**
	 * Returns the orderSentTo
	 *
	 * @return \integer $orderSentTo
	 */
	public function getOrderSentTo() {
		return $this->orderSentTo;
	}

	/**
	 * Sets the orderSentTo
	 *
	 * @param \integer $orderSentTo
	 * @return void
	 */
	public function setOrderSentTo($orderSentTo) {
		$this->orderSentTo = $orderSentTo;
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
	 * Returns the basketTotalPayment
	 *
	 * @return \float $basketTotalPayment
	 */
	public function getBasketTotalPayment() {
		return $this->basketTotalPayment;
	}

	/**
	 * Sets the basketTotalPayment
	 *
	 * @param \float $basketTotalPayment
	 * @return void
	 */
	public function setBasketTotalPayment($basketTotalPayment) {
		$this->basketTotalPayment = $basketTotalPayment;
	}

	/**
	 * Returns the pastClassPayment
	 *
	 * @return \float $pastClassPayment
	 */
	public function getPastClassPayment() {
		return $this->pastClassPayment;
	}

	/**
	 * Sets the pastClassPayment
	 *
	 * @param \float $pastClassPayment
	 * @return void
	 */
	public function setPastClassPayment($pastClassPayment) {
		$this->pastClassPayment = $pastClassPayment;
	}

	/**
	 * Returns the futureClassPayment
	 *
	 * @return \float $futureClassPayment
	 */
	public function getFutureClassPayment() {
		return $this->futureClassPayment;
	}

	/**
	 * Sets the futureClassPayment
	 *
	 * @param \float $futureClassPayment
	 * @return void
	 */
	public function setFutureClassPayment($futureClassPayment) {
		$this->futureClassPayment = $futureClassPayment;
	}
   
	/**
	 * Returns the deliveryPrice
	 *
	 * @return \integer $deliveryPrice
	 */
	public function getDeliveryPrice() {
		return $this->deliveryPrice;
	}

	/**
	 * Sets the deliveryPrice
	 *
	 * @param \integer $deliveryPrice
	 * @return void
	 */
	public function setDeliveryPrice($deliveryPrice) {
		$this->deliveryPrice = $deliveryPrice;
	}
   
   /**
	 * Returns the grandTotalPayment
	 *
	 * @return \float $grandTotalPayment
	 */
	public function getGrandTotalPayment() {
		return $this->grandTotalPayment;
	}

	/**
	 * Sets the grandTotalPayment
	 *
	 * @param \float $grandTotalPayment
	 * @return void
	 */
	public function setGrandTotalPayment($grandTotalPayment) {
		$this->grandTotalPayment = $grandTotalPayment;
	}   
   
	/**
	 * Returns the comment
	 *
	 * @return \string $comment
	 */
	public function getComment() {
		return $this->comment;
	}

	/**
	 * Sets the comment
	 *
	 * @param \string $comment
	 * @return void
	 */
	public function setComment($comment) {
		$this->comment = $comment;
	}

	/**
	 * Returns the year
	 *
	 * @return \integer $year
	 */
	public function getYear() {
		return $this->Year;
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