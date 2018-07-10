<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Condition;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Delete extends Action {
	protected $_resultPageFactory;
	protected $_resultPage;
	public function __construct(Context $context, PageFactory $resultPageFactory){
		parent::__construct($context);
		$this->_resultPageFactory = $resultPageFactory;
	}
	public function execute(){
		$id = $this->getRequest()->getParam('id');
		if($id>0){
			$model = $this->_objectManager->create('Krishaweb\Rma\Model\Condition');
			$model->load($id);
			try {
				$model->delete();
				$this->messageManager->addSuccess(__('Deleted.'));
			} catch (\Exception $e) {
				$this->messageManager->addSuccess(__('Something went wrong.'));
			}
		}
		$this->_redirect('rma/condition');
	}
	protected function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::condition');
	}
}