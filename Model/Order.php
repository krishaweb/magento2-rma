<?php

namespace Krishaweb\Rma\Model;

class Order extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'krishaweb_rma_order';

	protected $_cacheTag = 'krishaweb_rma_order';

	protected $_eventPrefix = 'krishaweb_rma_order';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\ResourceModel\Order');
	}
	public function getIdentities(){
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	public function getDefaultValues(){
		$values = [];
		return $values;
	}
}