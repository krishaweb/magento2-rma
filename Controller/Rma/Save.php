<?php
namespace Krishaweb\Rma\Controller\Rma;
class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Customer\Model\Session $customerSession,
		\Krishaweb\Rma\Model\RmaFactory $rma,
		\Krishaweb\Rma\Model\OrderFactory $rmaorder,
		\Magento\Framework\View\Result\PageFactory $pageFactory
	){
		$this->_customerSession = $customerSession;
		$this->_rma = $rma;
		$this->rmaorder = $rmaorder;
		$this->_pageFactory = $pageFactory;
		return parent::__construct($context);
	}
	public function execute()
	{
		die('1234');
		try{
			$data = $this->getRequest()->getPostValue();
			$params = array();
			$resultRedirect = $this->resultRedirectFactory->create();
			if(isset($data['check'])){
				foreach ($data['check'] as $key => $value) {
					if($value == 'on'){
						$params[$key]['item_id'] = $data['item_id'][$key];
						$params[$key]['qty_return'] = $data['qty_return'][$key];
						$params[$key]['reason'] = $data['reason'][$key];
						$params[$key]['condition'] = $data['condition'][$key];
						$params[$key]['order_id'] = $data['order_id'];
					}
				}
				foreach ($params as $key => $param) {
					if($param['qty_return'] == ""){
						throw new \Magento\Framework\Exception\LocalizedException(__('Please Selct option for selected product.'));
					}
					if($param['reason'] == ""){
						throw new \Magento\Framework\Exception\LocalizedException(__('Please Selct option for selected product.'));
					}
					if($param['condition'] == ""){
						throw new \Magento\Framework\Exception\LocalizedException(__('Please Selct option for selected product.'));
					}
				}

			}else{
				throw new \Magento\Framework\Exception\LocalizedException(__('Please Selct any Item'));
			}

			$rmaorderModel = $this->rmaorder->create();
			$rmaorderModel->setOrderId($data['order_id'])->save();

			$rmaModel = $this->_rma->create();
			foreach ($params as $key => $return) {
				$rmaModel->setData($return)->save();
				$this->messageManager->addSuccess(__('Saved.'));
				$resultRedirect->setPath('*/*/generate', ['id' => $data['order_id']]);
			}

		}catch (\Magento\Framework\Exception\LocalizedException $e) {
				$this->messageManager->addExceptionMessage($e);
				$resultRedirect->setPath('*/*/generate', ['id' => $data['order_id']]);
            
        } catch(\Exception $e){
			$this->messageManager->addException($e, __('Something went wrong.'));
			$resultRedirect->setPath('*/*/generate', ['id' => $data['order_id']]);
		}
		
		return $resultRedirect;
		
	}
}