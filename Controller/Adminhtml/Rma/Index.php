<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Rma;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		\Krishaweb\Rma\Model\OrderFactory $rmaorderFactory
	)
	{
		$this->resultPageFactory = $resultPageFactory;
		$this->_rmaorderFactory = $rmaorderFactory;
		parent::__construct($context);
	}

	public function execute(){
		
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Show All RMA')));
		return $resultPage;
	}
	public function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::showrma');
	}
}