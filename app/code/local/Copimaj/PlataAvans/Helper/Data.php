<?php
class Copimaj_PlataAvans_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function formatAvans($amount){
		return Mage::helper('avans')->__('Rest de plata - Avans');
	}
}