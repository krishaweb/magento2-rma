<?php
namespace Krishaweb\Rma\Controller\Rma;
class Generate extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Framework\View\Result\PageFactory $pageFactory)
	{
		$this->_customerSession = $customerSession;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		if (!$this->_customerSession->isLoggedIn()) {
            $urlInterface = $this->_objectManager->get('\Magento\Framework\UrlInterface');
            $this->_customerSession->setAfterAuthUrl($urlInterface->getCurrentUrl());
            $this->_customerSession->authenticate();
        }else{
			return $this->_pageFactory->create();
		}
	}
}