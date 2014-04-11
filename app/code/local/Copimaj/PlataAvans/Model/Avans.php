<?php
class Copimaj_PlataAvans_Model_Avans extends Mage_Core_Model_Abstract
{
	protected function _construct()
    {
        $this->_init('avans/avans');
    }   

  	public function getAvans($address) {
  		$percent = 70;

  		return $percent/100 * $address->getSubtotalWithDiscount() * -1;

  	}

  	public function canApply() {
  		return Mage::getSingleton('core/session')->getIsPlataAvans();
  	}
}