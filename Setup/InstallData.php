<?php
/**
 * Install checkout shipping notes
 *
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Quote\Setup\QuoteSetupFactory;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Class InstallData
 * @package Pyxl\ShippingNotes\Setup
 */
class InstallData implements InstallDataInterface
{

	/**
	 * SalesSetupFactory
	 *
	 * @var SalesSetupFactory
	 */
	protected $_salesSetupFactory;

	/**
	 * QuoteSetupFactory
	 *
	 * @var QuoteSetupFactory
	 */
	protected $_quoteSetupFactory;

	/**
	 * ModuleDataSetupInterface
	 *
	 * @var ModuleDataSetupInterface
	 */
	protected $_setup;

	/**
	 * InstallData constructor.
	 *
	 * @param SalesSetupFactory $salesSetupFactory SalesSetupFactory
	 * @param QuoteSetupFactory $quoteSetupFactory QuoteSetupFactory
	 */
	public function __construct(
		SalesSetupFactory $salesSetupFactory,
		QuoteSetupFactory $quoteSetupFactory
	) {
		$this->_salesSetupFactory = $salesSetupFactory;
		$this->_quoteSetupFactory = $quoteSetupFactory;
	}

	/**
	 * Install data
	 *
	 * @param ModuleDataSetupInterface $setup   ModuleDataSetupInterface
	 * @param ModuleContextInterface   $context ModuleContextInterface
	 *
	 * @return void
	 */
	public function install(
		ModuleDataSetupInterface $setup,
		ModuleContextInterface $context
	) {
		$this->_setup = $setup->startSetup();
		$this->installQuoteData();
		$this->installSalesData();
		$this->_setup = $setup->endSetup();
	}

	/**
	 * Install quote custom data
	 *
	 * @return void
	 */
	public function installQuoteData()
	{
		/** @var \Magento\Quote\Setup\QuoteSetup $quoteInstaller */
		$quoteInstaller = $this->_quoteSetupFactory->create(
			[
				'resourceName' => 'quote_setup',
				'setup' => $this->_setup
			]
		);
		$quoteInstaller
			->addAttribute(
				'quote',
				ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES,
				['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true, 'grid' => false]
			);
	}

	/**
	 * Install sales custom data
	 *
	 * @return void
	 */
	public function installSalesData()
	{
		/** @var \Magento\Sales\Setup\SalesSetup $salesInstaller */
		$salesInstaller = $this->_salesSetupFactory->create(
			[
				'resourceName' => 'sales_setup',
				'setup' => $this->_setup
			]
		);
		$salesInstaller
			->addAttribute(
				'order',
				ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES,
				['type' => Table::TYPE_TEXT, 'length' => '64k', 'nullable' => true, 'grid' => false]
			);
	}
}
