<?php

namespace Krishaweb\Rma\Model\ResourceModel\Rma;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection{

	protected $_idFieldName = 'rma_id';
	protected $_eventPrefix = 'krishaweb_rma_collection';
	protected $_eventObject = 'rma_collection';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\Rma', 'Krishaweb\Rma\Model\ResourceModel\Rma');
	}
}
