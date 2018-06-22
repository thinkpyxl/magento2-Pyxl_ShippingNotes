<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Class ShippingNotes
 * @package Pyxl\ShippingNotes\Model\Data
 */
class ShippingNotes extends AbstractExtensibleObject implements ShippingNotesInterface
{

	/**
	 * Get checkout shipping notes
	 *
	 * @return string|null
	 */
	public function getCheckoutShippingNotes() {
		return $this->_get(self::CHECKOUT_SHIPPING_NOTES);
	}

	/**
	 * Set checkout shipping notes
	 *
	 * @param string|null $checkoutShippingNotes
	 *
	 * @return ShippingNotesInterface
	 */
	public function setCheckoutShippingNotes( string $checkoutShippingNotes = null ) {
		return $this->setData(self::CHECKOUT_SHIPPING_NOTES, $checkoutShippingNotes);
	}

}