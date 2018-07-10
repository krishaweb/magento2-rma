<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Condition;

use \Magento\Backend\App\Action;
use \Magento\Backend\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;

class Save extends Action {
	protected $_resultPageFactory;
	protected $_resultPage;
	public function __construct(
		
			Context $context, 
			PageFactory $resultPageFactory
		){
		parent::__construct($context);
		$this->_resultPageFactory = $resultPageFactory;
	}
	public function execute(){
		$object_manager = $this->_objectManager;
		$directory = $object_manager->get('\Magento\Framework\Filesystem\DirectoryList');
		$data = $this->getRequest()->getPostValue();
		$resultRedirect = $this->resultRedirectFactory->create();
		$id = $this->getRequest()->getParam('id');
		$model = $this->_objectManager->create('Krishaweb\Rma\Model\Condition');
		
		$model->setData($data);
		try {
			$model->save();
			$this->messageManager->addSuccess(__('Saved.'));
			if ($this->getRequest()->getParam('back')) {
				return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
			}
			$this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
			return $resultRedirect->setPath('*/*/');
		} catch (\Exception $e) {
			$this->messageManager->addException($e, __('Something went wrong.'));
		}
		$this->_getSession()->setFormData($data);
		return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
	}
	protected function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::condition');
	}
}