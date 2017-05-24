<?php
namespace WX\WxLottery\Validation\Validator;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010-2013 Extbase Team (http://forge.typo3.org/projects/typo3v4-mvc)
 *  Extbase is a backport of TYPO3 Flow. All credits go to the TYPO3 Flow team.
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
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * A validator which accepts any input
 */
class CheckoutValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * Validates the given value
	 *
	 * @param mixed $value
	 * @return bool
	 */
	public function isValid($value) {
    $access = true;
    $postData = \TYPO3\CMS\Core\Utility\GeneralUtility::_POST('tx_wxlottery_checkout');
    $postData = $postData['newCheckout'];

    if( $value->getGender() == 0){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Gender is required!', time());
  		$this->result->forProperty('gender')->addError($error);
    
  		$access = false;    
    }
    
    if( $value->getCountry() == 0){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Country is required!', time());
  		$this->result->forProperty('country')->addError($error);
    
  		$access = false;    
    }

    if( array_key_exists('dGender', $postData) AND $value->getDGender() == 0){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Gender is required!', time());
  		$this->result->forProperty('dGender')->addError($error);
    
  		$access = false;    
    }
    
    if( array_key_exists('dFirstName', $postData) AND $value->getDFirstName() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('First name is required!', time());
  		$this->result->forProperty('dFirstName')->addError($error);
    
  		$access = false;    
    }
    
    if( array_key_exists('dLastName', $postData) AND $value->getDLastName() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Last name is required!', time());
  		$this->result->forProperty('dLastName')->addError($error);
    
  		$access = false;    
    } 
    
    if( array_key_exists('dAddress', $postData) AND $value->getDAddress() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Address is required!', time());
  		$this->result->forProperty('dAddress')->addError($error);
    
  		$access = false;    
    } 
    
    if( array_key_exists('dZip', $postData) AND $value->getDZip() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('ZIP is required!', time());
  		$this->result->forProperty('dZip')->addError($error);
    
  		$access = false;    
    }
    
    if( array_key_exists('dCity', $postData) AND $value->getDCity() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('City is required!', time());
  		$this->result->forProperty('dCity')->addError($error);
    
  		$access = false;    
    }
    
    if( array_key_exists('dCountry', $postData) AND $value->getDCountry() == ''){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Country is required!', time());
  		$this->result->forProperty('dCountry')->addError($error);
    
  		$access = false;    
    }
    
    if( array_key_exists('dEmail', $postData) AND !\TYPO3\CMS\Core\Utility\GeneralUtility::validEmail($value->getDEmail())){
      $error = new \TYPO3\CMS\Extbase\Validation\Error('Email is required!', time());
  		$this->result->forProperty('dEmail')->addError($error);
    
  		$access = false;    
    }  
    
		return $access;
	}
}

?>