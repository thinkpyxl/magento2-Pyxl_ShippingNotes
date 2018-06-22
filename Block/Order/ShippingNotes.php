<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Sales\Model\Order;
use Pyxl\ShippingNotes\Api\Data\ShippingNotesInterface;
use Pyxl\ShippingNotes\Api\ShippingNotesRepositoryInterface;

/**
 * Class ShippingNotes
 * @package Pyxl\ShippingNotes\Block\Order
 */
class ShippingNotes extends Template
{

	/**
	 * @var Registry|null
	 */
	protected $_coreRegistry = null;

	/**
	 * @var ShippingNotesRepositoryInterface
	 */
	protected $_shippingNotesRepository;

	/**
	 * ShippingNotes constructor.
	 *
	 * @param Context $context
	 * @param Registry $registry
	 * @param ShippingNotesRepositoryInterface $shippingNotesRepository
	 * @param array $data
	 */
	public function __construct(
		Template\Context $context,
		Registry $registry,
		ShippingNotesRepositoryInterface $shippingNotesRepository,
		array $data = []
	) {
		$this->_coreRegistry = $registry;
		$this->_shippingNotesRepository = $shippingNotesRepository;
		$this->_isScopePrivate = true;
		$this->_template = 'order/view/shipping_notes.phtml';
		parent::__construct( $context, $data );

	}

	/**
	 * Get current order
	 *
	 * @return Order
	 */
	public function getOrder() : Order {
		return $this->_coreRegistry->registry('current_order');
	}

	/**
	 * Get checkout shipping notes
	 *
	 * @param Order $order
	 *
	 * @return ShippingNotesInterface
	 */
	public function getShippingNotes( Order $order ) {
		return $this->_shippingNotesRepository->getShippingNotes($order);
	}

}