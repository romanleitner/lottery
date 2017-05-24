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
 * Test case for class \WX\WxLottery\Domain\Model\Product.
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
class ProductTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \WX\WxLottery\Domain\Model\Product
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \WX\WxLottery\Domain\Model\Product();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getIconReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIconForStringSetsIcon() { 
		$this->fixture->setIcon('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIcon()
		);
	}
	
	/**
	 * @test
	 */
	public function getWinPriceReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getWinPrice()
		);
	}

	/**
	 * @test
	 */
	public function setWinPriceForIntegerSetsWinPrice() { 
		$this->fixture->setWinPrice(12);

		$this->assertSame(
			12,
			$this->fixture->getWinPrice()
		);
	}
	
	/**
	 * @test
	 */
	public function getCostReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getCost()
		);
	}

	/**
	 * @test
	 */
	public function setCostForIntegerSetsCost() { 
		$this->fixture->setCost(12);

		$this->assertSame(
			12,
			$this->fixture->getCost()
		);
	}
	
	/**
	 * @test
	 */
	public function getChangesReturnsInitialValueForFloat() { 
		$this->assertSame(
			0.0,
			$this->fixture->getChanges()
		);
	}

	/**
	 * @test
	 */
	public function setChangesForFloatSetsChanges() { 
		$this->fixture->setChanges(3.14159265);

		$this->assertSame(
			3.14159265,
			$this->fixture->getChanges()
		);
	}
	
}
?>