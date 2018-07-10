<?php
namespace Krishaweb\Rma\Block\Adminhtml;
class Show extends \Magento\Framework\View\Element\Template
{
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Sales\Model\Order $order,
		\Magento\Sales\Model\Order\Item $orderitem,
		\Magento\Catalog\Model\Product $product,
		\Krishaweb\Rma\Model\Rma $rma,
		\Krishaweb\Rma\Model\Order $rmaorder,
		\Magento\Catalog\Model\ResourceModel\Eav\Attribute $attributeobj,
		\Magento\Catalog\Block\Product\ImageBuilder $_imageBuilder,
		\Krishaweb\Rma\Model\ReasonFactory $modelReasonFactory,
		\Krishaweb\Rma\Model\ConditionFactory $modelConditionFactory,
		\Krishaweb\Rma\Model\RmaFactory $modelRmaFactory,
		\Krishaweb\Rma\Model\OrderFactory $modelRmaOrderFactory,
		\Krishaweb\Rma\Model\StatusFactory $modelRmaStatusFactory
	){
		$this->order = $order;
		$this->orderitem = $orderitem;
		$this->rma = $rma;
		$this->rmaorder = $rmaorder;
		$this->product = $product;
		$this->_attributeobj = $attributeobj;
		$this->_imageBuilder = $_imageBuilder;
		$this->_modelReasonFactory = $modelReasonFactory;
		$this->_modelConditionFactory = $modelConditionFactory;
		$this->_modelRmaFactory = $modelRmaFactory;
		$this->_modelRmaOrderFactory = $modelRmaOrderFactory;
		$this->_modelRmaStatusFactory = $modelRmaStatusFactory;
		parent::__construct($context);
	}
	public function getRmaOrder($id){
		return $this->rmaorder->load($id);
	}
	public function getImage($product, $imageId, $attributes = [])
    {
        return $this->_imageBuilder->setProduct($product)
            ->setImageId($imageId)
            ->setAttributes($attributes)
            ->create();
    }
	public function getOrderData($id){

		
		$orderId = $this->rmaorder->load($id)->getOrderId();
		$allRmaItems = $this->_modelRmaFactory->create()->getCollection()->addFieldToFilter('order_id',array('eq'=>$orderId));
		
		/*$order = $this->order->load($orderId);
		$orderItems = $order->getItems();*/
		
		$orderInfo = array();
		foreach ($allRmaItems as $key => $rmaItem) {

			
			$orderItem = $this->orderitem->load($rmaItem->getItemId());


			if($orderItem->getProductType() == 'simple'){

				
				

				$orderInfo[$orderItem->getId()]['id'] = $orderItem->getId();
				$orderInfo[$orderItem->getId()]['product_id'] = $orderItem->getProductId();
				$orderInfo[$orderItem->getId()]['qty'] = $orderItem->getQtyOrdered();
				$product = $this->product->load($orderItem->getProductId());
				
				
				//$orderInfo[$orderItem->getId()]['img_url'] = $this->getImage($product, 'product_small_image')->getImageUrl();


				$orderInfo[$orderItem->getId()]['name'] = $orderItem->getName();
				$orderInfo[$orderItem->getId()]['sku'] = $orderItem->getSku();
				$orderInfo[$orderItem->getId()]['condition'] = $rmaItem->getCondition();
				$orderInfo[$orderItem->getId()]['reason'] = $rmaItem->getReason();
				
				if(array_key_exists('super_attribute', $orderItem->getProductOptions()['info_buyRequest'])){


					foreach ($orderItem->getProductOptions()['info_buyRequest']['super_attribute'] as $key => $attr) {
						
						

						$attribute = $this->_attributeobj->load($key);
						$attributeCode = $attribute->getAttributeCode();
						$attributeLabel = $attribute->getFrontendLabel();
						$optionLabel = $attribute->getSource()->getOptionText($attr);


						$orderInfo[$orderItem->getId()]['options'][$attributeCode]['attribute']['id'] = $key;
						$orderInfo[$orderItem->getId()]['options'][$attributeCode]['attribute']['label'] = $attributeLabel;


						$orderInfo[$orderItem->getId()]['options'][$attributeCode]['value']['id'] = $attr;
						$orderInfo[$orderItem->getId()]['options'][$attributeCode]['value']['label'] = $optionLabel;
						
					}

				}
			}
		}
		return $orderInfo;
	}

	public function getReasons(){
		$reasonModel = $this->_modelReasonFactory->create();
		return $reasonCollection = $reasonModel->getCollection();


	}
	public function getConditions(){
		$conditionModel = $this->_modelConditionFactory->create();
		return $conditionCollection = $conditionModel->getCollection();
	}
	public function getStatus(){
		$statusModel = $this->_modelRmaStatusFactory->create();
		return $statusCollection = $statusModel->getCollection();
	}
	public function checkRmaAvailable($item_id){
		$_modelRmaFactory = $this->_modelRmaFactory->create();
		return $_modelRmaFactory->getCollection()->addFieldToFilter('item_id',array('eq'=>$item_id));
	}
	public function getAvailableRma($item_id){
		$_modelRmaFactory = $this->_modelRmaFactory->create();
		$rmaId = $_modelRmaFactory->getCollection()->addFieldToFilter('item_id',array('eq'=>$item_id))->getFirstItem()->getRmaId();
		return $this->rma->load($rmaId);
	}

}