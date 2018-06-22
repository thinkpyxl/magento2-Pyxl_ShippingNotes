<?php
/**
 * Checkout shipping notes repository interface
 *
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Api;

use Magento\Sales\Model\Order;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Interface ShippingNotesRepositoryInterface
 * @package Pyxl\ShippingNotes\Api
 */
interface ShippingNotesRepositoryInterface
{

	/**
	 * Save checkout shipping notes
	 *
	 * @param int $cartId
	 * @param \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface $shippingNotes
	 *
	 * @return \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface
	 */
	public function saveShippingNotes(
		int $cartId,
		ShippingNotesInterface $shippingNotes
	): ShippingNotesInterface;

	/**
	 * Get checkout shipping notes
	 *
	 * @param Order $order Order
	 *
	 * @return \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface
	 */
	public function getShippingNotes(Order $order) : ShippingNotesInterface;

}