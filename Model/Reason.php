<?php

namespace Krishaweb\Rma\Model;

class Reason extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'krishaweb_rma_reason';

	protected $_cacheTag = 'krishaweb_rma_reason';

	protected $_eventPrefix = 'krishaweb_rma_reason';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\ResourceModel\Reason');
	}
	public function getIdentities(){
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	public function getDefaultValues(){
		$values = [];
		return $values;
	}
}