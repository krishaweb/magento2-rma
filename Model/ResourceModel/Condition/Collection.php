<?php

namespace Krishaweb\Rma\Model\ResourceModel\Condition;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{

	protected $_idFieldName = 'condition_id';
	protected $_eventPrefix = 'krishaweb_condition_collection';
	protected $_eventObject = 'condition_collection';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\Condition', 'Krishaweb\Rma\Model\ResourceModel\Condition');
	}
}
