<?php
namespace WX\WxLottery\ViewHelpers;

class PriceViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

   /**
   * @param $price string Each `allowed` param need to have its line in PHPDoc
   * @param $langId integer Each `allowed` param need to have its line in PHPDoc     
   * @return string
   */
   public function render($price, $langId) {
      if( $langId == 1 ){
      
      }else{
      
      }
/*
               <f:then>
                  <f:format.currency currencySign="£" decimalSeparator="." thousandsSeparator="," prependCurrency="TRUE" separateCurrency="true" decimals="2">{ticket.cost}</f:format.currency>
               </f:then>
               <f:else>
                  <f:translate key="tx_wxlottery_domain_model_ticket.currency" /> {ticket.cost},-
               </f:else>
            </f:if>
*/                  
     return 'xxx';
   }
}