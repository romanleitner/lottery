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
 * Test case for class \WX\WxLottery\Domain\Model\Basket.
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
class BasketTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \WX\WxLottery\Domain\Model\Basket
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \WX\WxLottery\Domain\Model\Basket();
	}

	public function tearDown() {
		unset($this->fixture);
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
	public function getIpAddressReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIpAddressForStringSetsIpAddress() { 
		$this->fixture->setIpAddress('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIpAddress()
		);
	}
	
	/**
	 * @test
	 */
	public function getHostReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setHostForStringSetsHost() { 
		$this->fixture->setHost('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getHost()
		);
	}
	
	/**
	 * @test
	 */
	public function getProductsReturnsInitialValueForBasketItem() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getProducts()
		);
	}

	/**
	 * @test
	 */
	public function setProductsForObjectStorageContainingBasketItemSetsProducts() { 
		$product = new \WX\WxLottery\Domain\Model\BasketItem();
		$objectStorageHoldingExactlyOneProducts = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneProducts->attach($product);
		$this->fixture->setProducts($objectStorageHoldingExactlyOneProducts);

		$this->assertSame(
			$objectStorageHoldingExactlyOneProducts,
			$this->fixture->getProducts()
		);
	}
	
	/**
	 * @test
	 */
	public function addProductToObjectStorageHoldingProducts() {
		$product = new \WX\WxLottery\Domain\Model\BasketItem();
		$objectStorageHoldingExactlyOneProduct = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneProduct->attach($product);
		$this->fixture->addProduct($product);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneProduct,
			$this->fixture->getProducts()
		);
	}

	/**
	 * @test
	 */
	public function removeProductFromObjectStorageHoldingProducts() {
		$product = new \WX\WxLottery\Domain\Model\BasketItem();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($product);
		$localObjectStorage->detach($product);
		$this->fixture->addProduct($product);
		$this->fixture->removeProduct($product);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getProducts()
		);
	}
	
}
?>