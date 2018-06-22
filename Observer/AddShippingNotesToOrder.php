<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Class AddShippingNotesToOrder
 * @package Pyxl\ShippingNotes\Observer
 */
class AddShippingNotesToOrder implements ObserverInterface
{

	/**
	 * Execute observer method.
	 *
	 * @param Observer $observer Observer
	 *
	 * @return void
	 */
	public function execute( Observer $observer ) {
		/** @var \Magento\Sales\Model\Order $order */
		$order = $observer->getEvent()->getOrder();
		/** @var \Magento\Quote\Model\Quote $quote */
		$quote = $observer->getEvent()->getQuote();

		$order->setData(
			ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES,
			$quote->getData(ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES)
		);
	}

}