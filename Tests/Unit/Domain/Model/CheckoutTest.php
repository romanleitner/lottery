<?php

namespace WX\WxLottery\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \WX\WxLottery\Domain\Model\Checkout.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Lottery
 *
 * @author Roman Leitner <rl@webaholix.com>
 */
class CheckoutTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \WX\WxLottery\Domain\Model\Checkout
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \WX\WxLottery\Domain\Model\Checkout();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() { 
		$this->fixture->setLastName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLastName()
		);
	}
	
	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() { 
		$this->fixture->setFirstName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFirstName()
		);
	}
	
	/**
	 * @test
	 */
	public function getGenderReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getGender()
		);
	}

	/**
	 * @test
	 */
	public function setGenderForIntegerSetsGender() { 
		$this->fixture->setGender(12);

		$this->assertSame(
			12,
			$this->fixture->getGender()
		);
	}
	
	/**
	 * @test
	 */
	public function getCountryReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCountry()
		);
	}

	/**
	 * @test
	 */
	public function setCountryForIntegerSetsCountry() { 
		$this->fixture->setCountry(12);

		$this->assertSame(
			12,
			$this->fixture->getCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() { 
		$this->fixture->setZip('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getZip()
		);
	}
	
	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() { 
		$this->fixture->setCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAddressForStringSetsAddress() { 
		$this->fixture->setAddress('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() { 
		$this->fixture->setEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getEmail()
		);
	}
	
	/**
	 * @test
	 */
	public function getSessionIdReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSessionIdForStringSetsSessionId() { 
		$this->fixture->setSessionId('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSessionId()
		);
	}
	
	/**
	 * @test
	 */
	public function getDGenderReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getDGender()
		);
	}

	/**
	 * @test
	 */
	public function setDGenderForIntegerSetsDGender() { 
		$this->fixture->setDGender(12);

		$this->assertSame(
			12,
			$this->fixture->getDGender()
		);
	}
	
	/**
	 * @test
	 */
	public function getDFirstNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDFirstNameForStringSetsDFirstName() { 
		$this->fixture->setDFirstName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDFirstName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDLastNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDLastNameForStringSetsDLastName() { 
		$this->fixture->setDLastName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDLastName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDCountryReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getDCountry()
		);
	}

	/**
	 * @test
	 */
	public function setDCountryForIntegerSetsDCountry() { 
		$this->fixture->setDCountry(12);

		$this->assertSame(
			12,
			$this->fixture->getDCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function getDZipReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDZipForStringSetsDZip() { 
		$this->fixture->setDZip('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDZip()
		);
	}
	
	/**
	 * @test
	 */
	public function getDCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDCityForStringSetsDCity() { 
		$this->fixture->setDCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getDAddressReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDAddressForStringSetsDAddress() { 
		$this->fixture->setDAddress('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getDEmailReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDEmailForStringSetsDEmail() { 
		$this->fixture->setDEmail('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDEmail()
		);
	}
	
	/**
	 * @test
	 */
	public function getFinishedStepReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getFinishedStep()
		);
	}

	/**
	 * @test
	 */
	public function setFinishedStepForIntegerSetsFinishedStep() { 
		$this->fixture->setFinishedStep(12);

		$this->assertSame(
			12,
			$this->fixture->getFinishedStep()
		);
	}
	
	/**
	 * @test
	 */
	public function getDeliveryReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getDelivery()
		);
	}

	/**
	 * @test
	 */
	public function setDeliveryForIntegerSetsDelivery() { 
		$this->fixture->setDelivery(12);

		$this->assertSame(
			12,
			$this->fixture->getDelivery()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPayment()
		);
	}

	/**
	 * @test
	 */
	public function setPaymentForIntegerSetsPayment() { 
		$this->fixture->setPayment(12);

		$this->assertSame(
			12,
			$this->fixture->getPayment()
		);
	}
	
	/**
	 * @test
	 */
	public function getBuyAllClassesReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getBuyAllClasses()
		);
	}

	/**
	 * @test
	 */
	public function setBuyAllClassesForIntegerSetsBuyAllClasses() { 
		$this->fixture->setBuyAllClasses(12);

		$this->assertSame(
			12,
			$this->fixture->getBuyAllClasses()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebitBankNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitBankNameForStringSetsDebitBankName() { 
		$this->fixture->setDebitBankName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitBankName()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebitSortCodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitSortCodeForStringSetsDebitSortCode() { 
		$this->fixture->setDebitSortCode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitSortCode()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebitAccountNrReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebitAccountNrForStringSetsDebitAccountNr() { 
		$this->fixture->setDebitAccountNr('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebitAccountNr()
		);
	}
	
	/**
	 * @test
	 */
	public function getDebigAccountHolderReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDebigAccountHolderForStringSetsDebigAccountHolder() { 
		$this->fixture->setDebigAccountHolder('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDebigAccountHolder()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcHolderNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCcHolderNameForStringSetsCcHolderName() { 
		$this->fixture->setCcHolderName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCcHolderName()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcTypeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCcTypeForStringSetsCcType() { 
		$this->fixture->setCcType('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCcType()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcAccountNrReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCcAccountNrForStringSetsCcAccountNr() { 
		$this->fixture->setCcAccountNr('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCcAccountNr()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcExpireMonthReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCcExpireMonth()
		);
	}

	/**
	 * @test
	 */
	public function setCcExpireMonthForIntegerSetsCcExpireMonth() { 
		$this->fixture->setCcExpireMonth(12);

		$this->assertSame(
			12,
			$this->fixture->getCcExpireMonth()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcExpireYearReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCcExpireYear()
		);
	}

	/**
	 * @test
	 */
	public function setCcExpireYearForIntegerSetsCcExpireYear() { 
		$this->fixture->setCcExpireYear(12);

		$this->assertSame(
			12,
			$this->fixture->getCcExpireYear()
		);
	}
	
	/**
	 * @test
	 */
	public function getCcVerificationNrReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCcVerificationNr()
		);
	}

	/**
	 * @test
	 */
	public function setCcVerificationNrForIntegerSetsCcVerificationNr() { 
		$this->fixture->setCcVerificationNr(12);

		$this->assertSame(
			12,
			$this->fixture->getCcVerificationNr()
		);
	}
	
	/**
	 * @test
	 */
	public function getPaymentInfoReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setPaymentInfoForStringSetsPaymentInfo() { 
		$this->fixture->setPaymentInfo('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getPaymentInfo()
		);
	}
	
	/**
	 * @test
	 */
	public function getOrderSentToReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getOrderSentTo()
		);
	}

	/**
	 * @test
	 */
	public function setOrderSentToForIntegerSetsOrderSentTo() { 
		$this->fixture->setOrderSentTo(12);

		$this->assertSame(
			12,
			$this->fixture->getOrderSentTo()
		);
	}
	
	/**
	 * @test
	 */
	public function getPastClassPaymentReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPastClassPayment()
		);
	}

	/**
	 * @test
	 */
	public function setPastClassPaymentForIntegerSetsPastClassPayment() { 
		$this->fixture->setPastClassPayment(12);

		$this->assertSame(
			12,
			$this->fixture->getPastClassPayment()
		);
	}
	
	/**
	 * @test
	 */
	public function getFutureClassPaymentReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getFutureClassPayment()
		);
	}

	/**
	 * @test
	 */
	public function setFutureClassPaymentForIntegerSetsFutureClassPayment() { 
		$this->fixture->setFutureClassPayment(12);

		$this->assertSame(
			12,
			$this->fixture->getFutureClassPayment()
		);
	}
	
	/**
	 * @test
	 */
	public function getDeliveryPriceReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getDeliveryPrice()
		);
	}

	/**
	 * @test
	 */
	public function setDeliveryPriceForIntegerSetsDeliveryPrice() { 
		$this->fixture->setDeliveryPrice(12);

		$this->assertSame(
			12,
			$this->fixture->getDeliveryPrice()
		);
	}
	
}
?>