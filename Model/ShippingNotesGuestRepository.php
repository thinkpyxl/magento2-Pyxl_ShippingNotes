<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Model;

use Magento\Quote\Model\QuoteIdMaskFactory;
use Pyxl\ShippingNotes\Api\ShippingNotesGuestRepositoryInterface;
use Pyxl\ShippingNotes\Api\ShippingNotesRepositoryInterface;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

/**
 * Class ShippingNotesGuestRepository
 * @package Pyxl\ShippingNotes\Model
 */
class ShippingNotesGuestRepository implements ShippingNotesGuestRepositoryInterface
{

	/**
	 * @var QuoteIdMaskFactory
	 */
	protected $_quoteIdMaskFactory;

	/**
	 * @var ShippingNotesRepositoryInterface
	 */
	protected $_shippingNotesRepository;

	/**
	 * @param QuoteIdMaskFactory               $quoteIdMaskFactory
	 * @param ShippingNotesRepositoryInterface $shippingNotesRepository
	 */
	public function __construct(
		QuoteIdMaskFactory $quoteIdMaskFactory,
		ShippingNotesRepositoryInterface $shippingNotesRepository
	) {
		$this->_quoteIdMaskFactory     = $quoteIdMaskFactory;
		$this->_shippingNotesRepository = $shippingNotesRepository;
	}

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
	): ShippingNotesInterface {
		/** @var \Magento\Quote\Model\Quote  $quoteIdMask */
		$quoteIdMask = $this->_quoteIdMaskFactory->create()->load($cartId, 'masked_id');
		return $this->_shippingNotesRepository->saveShippingNotes((int)$quoteIdMask->getQuoteId(), $shippingNotes);
	}

}