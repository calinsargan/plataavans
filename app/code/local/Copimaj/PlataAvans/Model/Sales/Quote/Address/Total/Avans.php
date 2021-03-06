<?php
class Copimaj_PlataAvans_Model_Sales_Quote_Address_Total_Avans extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
	protected $_code = 'avans';

	public function collect(Mage_Sales_Model_Quote_Address $address)
	{
		
		parent::collect($address);

		$this->_setAmount(0);
        $this->_setBaseAmount(0);
 
        $items = $this->_getAddressItems($address);
        if (!count($items)) {
            return $this; //this makes only address type shipping to come through
        }
 
        $quote = $address->getQuote();

        $balance = 0;
    
        if(Mage::getSingleton('avans/avans')->canApply()){ //your business logic
            $exist_amount = $quote->getFeeAmount();
            $fee = Mage::getModel('avans/avans')->getAvans($address);

            // $balance = $fee - $exist_amount;
            $balance = $fee;

            
        } 

        $address->setFeeAmount($balance);
        $address->setBaseFeeAmount($balance);
             
        $quote->setFeeAmount($balance);

        $address->setGrandTotal($address->getGrandTotal() + $address->getFeeAmount());
        $address->setBaseGrandTotal($address->getBaseGrandTotal() + $address->getBaseFeeAmount());

	}

	public function fetch(Mage_Sales_Model_Quote_Address $address)
	{
		$amt = $address->getFeeAmount();

        if ($amt != 0) {
            $address->addTotal(array(
                'code'=>$this->getCode(),
                'title'=>Mage::helper('avans')->__('Rest de plata - Avans'),
                'value'=> $amt
            ));    
        }
        
        return $this;
	}
}