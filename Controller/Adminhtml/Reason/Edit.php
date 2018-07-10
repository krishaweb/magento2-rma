<?php

namespace Krishaweb\Rma\Controller\Adminhtml\Reason;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action{
	protected $_coreRegistry = null;
	protected $resultPageFactory;
	public function __construct(
		Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $registry
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $registry;
		parent::__construct($context);
	}
	protected function _isAllowed(){
		return $this->_authorization->isAllowed('Krishaweb_Rma::reason');
	}
	protected function _initAction(){
		$resultPage = $this->resultPageFactory->create();
		$resultPage->setActiveMenu('Krishaweb_Rma::reason')
			->addBreadcrumb(__('Rma'), __('Rma'))
			->addBreadcrumb(__('Reason'), __('Items'))
			->addBreadcrumb(__('Edit'), __('Edit'));
		return $resultPage;
	}
	public function execute(){

		$id = $this->getRequest()->getParam('id');
		$model = $this->_objectManager->create('Krishaweb\Rma\Model\Reason');
		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				$resultRedirect = $this->resultRedirectFactory->create();
				return $resultRedirect->setPath('*/*/');
			}
		}
		$data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}
		$this->_coreRegistry->register('reason_item', $model);
		$resultPage = $this->_initAction();
		$resultPage->getConfig()->getTitle()->prepend(__('Rma'));
		$resultPage->getConfig()->getTitle()->prepend(__('Items'));
		$resultPage->getConfig()->getTitle()
			->prepend(__('Edit'));
		return $resultPage;
	}
}