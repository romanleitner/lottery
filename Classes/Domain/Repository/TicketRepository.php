<?php
namespace WX\WxLottery\Domain\Repository;

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
class TicketRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	
	public function findTicketsForLandpageSettings() {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching(
			$query->logicalAnd(
				$query->equals('deleted', 0),
				$query->equals('hidden', 0),
				$query->logicalNot(
					$query->equals('title', 'Superklasse')
				)
			)
		);
		return $query->execute()->toArray();
	}

	public function findLandpageTicket() {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->matching(
			$query->logicalAnd(
				$query->equals('deleted', 0),
				$query->equals('hidden', 0),
				$query->equals('landpage', 1)
			)
		);
		return $query->execute()->getFirst();
	}
   
  	public function _persistAll() {
		$this->persistenceManager->persistAll();
	}
}
