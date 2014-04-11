<?php
class Copimaj_PlataAvans_IndexController extends Mage_Core_Controller_Front_Action
{
	public function stateAction() {
		$is = (boolean)$this->getRequest()->getParam('is');
		if ($is===true) {
			// add session
			Mage::getSingleton('core/session')->setIsPlataAvans(true);
		} else {
			// remove session
			Mage::getSingleton('core/session')->setIsPlataAvans(false);
		}

		if ($payment = $this->getRequest()->getParam('payment')) {
			Mage::getSingleton('core/session')->setPaymentType($payment);	
		}

	}

	public function uninstallAction() {

		$key = $this->getRequest()->getParam('key');

		if ($key != 'onlyme') {
			echo 'Unauthorized.';
			return;
		}

		$res = Mage::getSingleton('core/resource');
		$connection = $res->getConnection('core_write');
		
		// core_resource
		$query = "
			DELETE FROM `".$res->getTableName('core/resource')."` WHERE `code` = 'avans_setup'; 
		";

		// 0.1.4
		$query .= "
			ALTER TABLE `".$res->getTableName('sales/order')."` DROP COLUMN `fee_amount_refunded`;
			ALTER TABLE `".$res->getTableName('sales/order')."` DROP COLUMN `base_fee_amount_refunded`;
			ALTER TABLE `".$res->getTableName('sales/creditmemo')."` DROP COLUMN `fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/creditmemo')."` DROP COLUMN `base_fee_amount`;
		";
		// 0.1.3
		$query .= "
			ALTER TABLE `".$res->getTableName('sales/invoice')."` DROP COLUMN `fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/invoice')."` DROP COLUMN `base_fee_amount`;
		";

		// 0.1.2
		$query .= "
			ALTER TABLE `".$res->getTableName('sales/order')."` DROP COLUMN `fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/order')."` DROP COLUMN `base_fee_amount`;
		";

		// 0.1.1
		$query .= "
			ALTER TABLE `".$res->getTableName('sales/quote')."` DROP COLUMN `fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/quote')."` DROP COLUMN `base_fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/quote_address')."` DROP COLUMN `fee_amount`;
			ALTER TABLE `".$res->getTableName('sales/quote_address')."` DROP COLUMN `base_fee_amount`;
		";

		// 0.1.0

		/**
		* Execute the query
		*/
		try {
			$connection->beginTransaction();
			$connection->query($query);
			$connection->commit();
			echo "All done.";
		} catch (Exception $ex) {
			$connection->rollBack();
			echo $ex->getMessage();
		}
	}
}