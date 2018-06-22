<?php
/**
 * Uninstall checkout shipping notes
 *
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Class Uninstall
 * @package Pyxl\ShippingNotes\Setup
 */
class Uninstall implements UninstallInterface
{
	
	/**
	 * SchemaSetupInterface
	 *
	 * @var SchemaSetupInterface
	 */
	protected $_setup;

	/**
	 * Uninstall data
	 *
	 * @param SchemaSetupInterface   $setup   SchemaSetupInterface
	 * @param ModuleContextInterface $context ModuleContextInterface
	 *
	 * @return void
	 */
	public function uninstall(
		SchemaSetupInterface $setup,
		ModuleContextInterface $context
	) {
		$this->_setup = $setup->startSetup();
		$this->uninstallQuoteData();
		$this->uninstallSalesData();
		$this->_setup = $setup->endSetup();
	}

	/**
	 * Uninstall quote shipping notes
	 *
	 * @return void
	 */
	public function uninstallQuoteData()
	{
		$this->_setup->getConnection()->dropColumn(
			$this->_setup->getTable('quote'),
			ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES
		);
	}

	/**
	 * Uninstall sales shipping notes
	 *
	 * @return void
	 */
	public function uninstallSalesData()
	{
		$this->_setup->getConnection()->dropColumn(
			$this->_setup->getTable('sales_order'),
			ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES
		);
	}
}