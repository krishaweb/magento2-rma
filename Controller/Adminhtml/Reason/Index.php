<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Reason;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		\Krishaweb\Rma\Model\ReasonFactory $reasonFactory
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_reasonFactory = $reasonFactory;
		parent::__construct($context);
	}

	public function execute(){

		
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Reason')));
		return $resultPage;
	}
	public function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::reason');
	}
}