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
class PartnerLogRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

   public function findAll(){
      $query = $this->createQuery();
      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      $query->matching(
         $query->logicalAnd(
            $query->equals('deleted', 0)
         )
      );
      
      return $query->execute();
   }
   
	/*
	 * Check if given product is not in basket already
	 *
	 */
	public function findByPartnerAndCurrency($partnerId, $currencyId){
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				$query->equals('partner', $partnerId),
				$query->equals('currency', $currencyId)
			)
		);

		return $query->execute();
	}

   public function findBySessionId($sessionId){
      $query = $this->createQuery();
      $query->getQuerySettings()->setRespectStoragePage(FALSE);
      $query->matching(
         $query->logicalAnd(
				$query->equals('session_id', $sessionId)
         )
      );

      return $query->execute()->getFirst();
   }


	/**
	 * Returns highest (or current) Year of lottery
	 * @return int
	 */
	public function getHighestYear() {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->statement("SELECT MAX(year) as year FROM `tx_wxlottery_domain_model_partnerlog`");
		return $query->execute()->getFirst()->getYear();
   }
}
