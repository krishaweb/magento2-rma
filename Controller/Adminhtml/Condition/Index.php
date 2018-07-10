<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Condition;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		\Krishaweb\Rma\Model\ConditionFactory $conditionFactory
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_conditionFactory = $conditionFactory;
		parent::__construct($context);
	}

	public function execute(){

		
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Condition')));
		return $resultPage;
	}
	public function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::condition');
	}
}