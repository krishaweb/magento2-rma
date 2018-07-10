<?php

namespace Krishaweb\Rma\Model;

class Status extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'krishaweb_rma_status';

	protected $_cacheTag = 'krishaweb_rma_status';

	protected $_eventPrefix = 'krishaweb_rma_status';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\ResourceModel\Status');
	}
	public function getIdentities(){
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	public function getDefaultValues(){
		$values = [];
		return $values;
	}
}