<?php

namespace Krishaweb\Rma\Model\ResourceModel\Reason;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{

	protected $_idFieldName = 'reason_id';
	protected $_eventPrefix = 'krishaweb_reason_collection';
	protected $_eventObject = 'reason_collection';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\Reason', 'Krishaweb\Rma\Model\ResourceModel\Reason');
	}
}
