<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Status;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		\Krishaweb\Rma\Model\StatusFactory $statusFactory
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_statusFactory = $statusFactory;
		parent::__construct($context);
	}

	public function execute(){

		
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Status')));
		return $resultPage;
	}
	public function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::status');
	}
}