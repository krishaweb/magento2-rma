<?php

namespace Krishaweb\Rma\Model\ResourceModel\Status;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{

	protected $_idFieldName = 'status_id';
	protected $_eventPrefix = 'krishaweb_status_collection';
	protected $_eventObject = 'status_collection';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\Status', 'Krishaweb\Rma\Model\ResourceModel\Status');
	}
}
