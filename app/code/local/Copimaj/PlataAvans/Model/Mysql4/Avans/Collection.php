<?php
 
class Copimaj_PlataAvans_Model_Mysql4_Avans_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('avans/avans');
    }
}