<?php
/**
 * Checkout shipping notes guest repository interface
 *
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Api;

use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Interface ShippingNotesGuestRepositoryInterface
 * @package Pyxl\ShippingNotes\Api
 */
interface ShippingNotesGuestRepositoryInterface
{

	/**
	 * Save checkout shipping notes
	 *
	 * @param string $cartId
	 * @param \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface $shippingNotes
	 *
	 * @return \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface
	 */
	public function saveShippingNotes(
		string $cartId,
		ShippingNotesInterface $shippingNotes
	): ShippingNotesInterface;

}