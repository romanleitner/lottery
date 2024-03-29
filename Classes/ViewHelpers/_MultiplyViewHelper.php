<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Claus Due <claus@wildside.dk>, Wildside A/S
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
 * ### Math: Product (multiplication)
 *
 * Product (multiplication) of $a and $b. A can be an array and $b a
 * number, in which case each member of $a gets multiplied by $b.
 * If $a is an array and $b is not provided then array_product is
 * used to return a single numeric value. If both $a and $b are
 * arrays, each member of $a is multiplied against the corresponding
 * member in $b compared using index.
 *
 * @author Claus Due <claus@wildside.dk>, Wildside A/S
 * @package Vhs
 * @subpackage ViewHelpers\Math
 */
class Tx_WxLottery_ViewHelpers_MultiplyViewHelper extends Tx_Vhs_ViewHelpers_Math_AbstractMultipleMathViewHelper {

	/**
	 * @return mixed
	 * @throw Exception
	 */
	public function render() {
		$a = $this->getInlineArgument();
		$b = $this->arguments['b'];
		$aIsIterable = $this->assertIsArrayOrIterator($a);
		if ($aIsIterable && $b === NULL) {
			$a = $this->convertTraversableToArray($a);
			return array_product($a);
		}
		return $this->calculate($a, $b);
	}

	/**
	 * @param mixed $a
	 * @param mixed $b
	 * @return mixed
	 */
	protected function calculateAction($a, $b) {
		return round($a * $b, 2);
	}

}
