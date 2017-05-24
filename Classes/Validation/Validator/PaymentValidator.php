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
class PaymentValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

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

      if(!array_key_exists('delivery', $postData)){
         $error = new \TYPO3\CMS\Extbase\Validation\Error('Please select delivery method', time());
         $this->result->forProperty('delivery')->addError($error);
     
     	   $access = false;        
      }

      if(!array_key_exists('payment', $postData)){
         $error = new \TYPO3\CMS\Extbase\Validation\Error('Please select payment method', time());
         $this->result->forProperty('payment')->addError($error);
     
     	   $access = false;        
      }
      
      if(!array_key_exists('buyAllClasses', $postData)){
         $error = new \TYPO3\CMS\Extbase\Validation\Error('Please select nr of classes', time());
         $this->result->forProperty('buyAllClasses')->addError($error);
     
     	   $access = false;        
      }

      // Bankeinzug (bis auf Widerruf)
      if($postData['payment'] == 2){
         //Debit Bank name        
         if( $value->getDebitBankName() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Bank name is required!', time());
            $this->result->forProperty('debitBankName')->addError($error);
        
        	   $access = false;    
        }
        
        //Debit Bank sort code
        if( $value->getDebitSortCode() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Bank sort code is required!', time());
            $this->result->forProperty('debitSortCode')->addError($error);
        
        	   $access = false;    
        }
        
        //Debit Bank account nr
        if( $value->getDebitAccountNr() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Account Nr. is required!', time());
            $this->result->forProperty('debitAccountNr')->addError($error);
        
        	   $access = false;    
        }
        
        //Debit Accouunt holder name
        if( $value->getDebigAccountHolder() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Account holder name is required!', time());
            $this->result->forProperty('debigAccountHolder')->addError($error);
        
        	   $access = false;    
        }    
      }
      
      // Kreditkarte (bis auf Widerruf)
      if($postData['payment'] == 3){
         //CC holder name
         if( $value->getCcHolderName() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccHolderName')->addError($error);
        
        	   $access = false;    
        }
        
        //CC card type
        if( $value->getCcType() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccType')->addError($error);
        
        	   $access = false;    
        } 
        
        //CC account nr.
        if( $value->getCcAccountNr() == '' OR !$this->checkLuhn($value->getCcAccountNr()) OR !$this->checkFirstDigit($value->getCcAccountNr(), $value->getCcType()) ){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccAccountNr')->addError($error);
        
        	   $access = false;    
        }
        
        // CC expire month 
        if( $value->getCcExpireMonth() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccExpireMonth')->addError($error);
        
        	   $access = false;    
        }
        
        //CC expire year 
        if( $value->getCcExpireYear() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccExpireYear')->addError($error);
        
        	   $access = false;    
        }
        
        //CC veryfication nr.
        if( $value->getCcVerificationNr() == ''){
            $error = new \TYPO3\CMS\Extbase\Validation\Error('Holder name is required!', time());
            $this->result->forProperty('ccVerificationNr')->addError($error);
        
        	   $access = false;    
        }     
      }   

    
		return $access;
	}
   
   protected function checkFirstDigit($number, $type){
      switch ($type) {
         case '1':
            //Mastercard, should start with 5
            return substr($number, 0, 1) == 5 ? true : false;  
         	break;
         case '2':
            //Visa should start with 4
            return substr($number, 0, 1) == 4 ? true : false; 
         	break;
         default:
      	  return false;
      	  break;
      }      
   }
   
   protected function checkLuhn($number) {
      $sum = 0;
      $numDigits = strlen($number)-1;
      $parity = $numDigits % 2;
      for ($i = $numDigits; $i >= 0; $i--) {
         $digit = substr($number, $i, 1);
         if (!$parity == ($i % 2)) {$digit <<= 1;}
         $digit = ($digit > 9) ? ($digit - 9) : $digit;
         $sum += $digit;
      }
      return (0 == ($sum % 10));
   }
}

?>