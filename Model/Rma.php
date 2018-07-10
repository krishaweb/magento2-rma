<?php

namespace Krishaweb\Rma\Model;

class Rma extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'krishaweb_rma_rma';

	protected $_cacheTag = 'krishaweb_rma_rma';

	protected $_eventPrefix = 'krishaweb_rma_rma';


	protected function _construct()
	{
		$this->_init('Krishaweb\Rma\Model\ResourceModel\Rma');
	}
	public function getIdentities(){
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	public function getDefaultValues(){
		$values = [];
		return $values;
	}
}