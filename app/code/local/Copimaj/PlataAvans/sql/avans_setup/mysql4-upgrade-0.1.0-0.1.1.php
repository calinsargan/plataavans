<?php

$installer = $this;

$installer->startSetup();

$installer->run("
    #DROP TABLE IF EXISTS {$this->getTable('copimaj_plataavans')};

    ALTER TABLE  `".$this->getTable('sales/quote')."` ADD  `fee_amount` DECIMAL( 10, 2 ) NOT NULL;
    ALTER TABLE  `".$this->getTable('sales/quote')."` ADD  `base_fee_amount` DECIMAL( 10, 2 ) NOT NULL;

    ALTER TABLE  `".$this->getTable('sales/quote_address')."` ADD  `fee_amount` DECIMAL( 10, 2 ) NOT NULL;
    ALTER TABLE  `".$this->getTable('sales/quote_address')."` ADD  `base_fee_amount` DECIMAL( 10, 2 ) NOT NULL;

  ");

$installer->endSetup(); 