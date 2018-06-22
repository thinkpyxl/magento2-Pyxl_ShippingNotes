<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Api\Data;

/**
 * Interface ShippingNotesInterface
 * @package Pyxl\ShippingNotes\Api\Data
 */
interface ShippingNotesInterface
{
	const CHECKOUT_SHIPPING_NOTES = 'checkout_shipping_notes';

	/**
	 * Get checkout shipping notes
	 *
	 * @return string|null
	 */
	public function getCheckoutShippingNotes();

	/**
	 * Set checkout shipping notes
	 *
	 * @param string|null $checkoutShippingNotes
	 * @return ShippingNotesInterface
	 */
	public function setCheckoutShippingNotes(string $checkoutShippingNotes = null);

}
