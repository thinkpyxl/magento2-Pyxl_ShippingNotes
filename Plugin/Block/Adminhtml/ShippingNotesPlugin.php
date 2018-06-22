<?php
/**
 * @category    Pyxl
 * @package     Pyxl_ShippingNotes
 * @copyright   © Pyxl, Inc. All rights reserved.
 * @license     See LICENSE.txt for license details.
 * @author      Joel Rainwater <jrainwater@pyxl.com>
 */

declare(strict_types=1);

namespace Pyxl\ShippingNotes\Plugin\Block\Adminhtml;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Block\Adminhtml\Order\View\Info;
use Pyxl\ShippingNotes\Api\ShippingNotesRepositoryInterface;

/**
 * Class ShippingNotesPlugin
 * @package Pyxl\ShippingNotes\Plugin\Block\Adminhtml
 */
class ShippingNotesPlugin
{

	/**
	 * @var ShippingNotesRepositoryInterface
	 */
	protected $_shippingNotesRepository;

	/**
	 * ShippingNotesPlugin constructor.
	 *
	 * @param ShippingNotesRepositoryInterface $shippingNotesRepository
	 */
	public function __construct(
		ShippingNotesRepositoryInterface $shippingNotesRepository
	) {
		$this->_shippingNotesRepository = $shippingNotesRepository;
	}

	/**
	 * Add shipping notes to order view block
	 *
	 * @param Info $subject
	 * @param string $result
	 *
	 * @return string
	 * @throws LocalizedException
	 */
	public function afterToHtml( Info $subject, $result ) {
		$block = $subject->getLayout()->getBlock('order_shipping_notes');
		if ($block !== false) {
			$block->setOrderShippingNotes(
				$this->_shippingNotesRepository->getShippingNotes($subject->getOrder())
			);
			$result = $result . $block->toHtml();
		}

		return $result;
	}

}