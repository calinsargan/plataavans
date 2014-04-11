<?php

$installer = $this;

$installer->startSetup();

// $installer->run("
//     DROP TABLE IF EXISTS {$this->getTable('copimaj_plataavans')};

//     CREATE TABLE {$this->getTable('copimaj_plataavans')} (
//       `avans_id` int(11) NOT NULL AUTO_INCREMENT,
//       `parent_id` int(11) NOT NULL,
//       `avans_amount` bigint(20) NOT NULL,
//       PRIMARY KEY (`avans_id`)
//     ) ENGINE=MyISAM  DEFAULT CHARSET=utf8
//   ");

$installer->endSetup(); 