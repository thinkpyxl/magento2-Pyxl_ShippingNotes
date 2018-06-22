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

use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Sales\Model\Order;
use Pyxl\ShippingNotes\Api\ShippingNotesRepositoryInterface;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;

class ShippingNotesRepository implements ShippingNotesRepositoryInterface
{

	/**
	 * Quote repository.
	 *
	 * @var CartRepositoryInterface
	 */
	protected $_cartRepository;

	/**
	 * ScopeConfigInterface
	 *
	 * @var ScopeConfigInterface
	 */
	protected $_scopeConfig;

	/**
	 * @var ShippingNotesInterface
	 */
	protected $_shippingNotes;

	/**
	 * ShippingNotesRepository constructor.
	 *
	 * @param CartRepositoryInterface $cartRepository CartRepositoryInterface
	 * @param ScopeConfigInterface    $scopeConfig    ScopeConfigInterface
	 * @param ShippingNotesInterface   $shippingNotes   ShippingNotesInterface
	 */
	public function __construct(
		CartRepositoryInterface $cartRepository,
		ScopeConfigInterface $scopeConfig,
		ShippingNotesInterface $shippingNotes
	) {
		$this->_cartRepository = $cartRepository;
		$this->_scopeConfig    = $scopeConfig;
		$this->_shippingNotes   = $shippingNotes;
	}

	/**
	 * Save checkout shipping notes
	 *
	 * @param int $cartId
	 * @param \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface $shippingNotes
	 *
	 * @return \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface
	 * @throws NoSuchEntityException
	 * @throws CouldNotSaveException
	 */
	public function saveShippingNotes(
		int $cartId,
		ShippingNotesInterface $shippingNotes
	): ShippingNotesInterface {
		/** @var \Magento\Quote\Model\Quote $cart */
		$cart = $this->_cartRepository->getActive($cartId);
		if (!$cart->getItemsCount()) {
			throw new NoSuchEntityException(__('Cart %1 is empty', $cartId));
		}

		try {
			$cart->setData(
				ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES,
				$shippingNotes->getCheckoutShippingNotes()
			);
			$this->_cartRepository->save($cart);
		} catch (\Exception $e) {
			throw new CouldNotSaveException(__('Custom order data could not be saved!'));
		}

		return $shippingNotes;
	}

	/**
	 * Get checkout shipping notes
	 *
	 * @param Order $order Order
	 *
	 * @return \Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface
	 * @throws NoSuchEntityException
	 */
	public function getShippingNotes( Order $order ): ShippingNotesInterface {
		if (!$order->getId()) {
			throw new NoSuchEntityException(__('Order %1 does not exist', $order));
		}

		$this->_shippingNotes->setCheckoutShippingNotes(
			$order->getData(ShippingNotesInterface::CHECKOUT_SHIPPING_NOTES)
		);

		return $this->_shippingNotes;
	}

}