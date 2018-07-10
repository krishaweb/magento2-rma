<?php

namespace Krishaweb\Rma\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{

	protected $_idFieldName = 'rma_order_id';
	protected $_eventPrefix = 'krishaweb_order_collection';
	protected $_eventObject = 'order_collection';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\Order', 'Krishaweb\Rma\Model\ResourceModel\Order');
	}
}
