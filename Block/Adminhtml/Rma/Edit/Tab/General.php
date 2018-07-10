<?php

namespace Krishaweb\Rma\Block\Adminhtml\Rma\Edit\Tab;
 
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
 
class General extends Generic implements TabInterface {
	protected $_wysiwygConfig;
	protected $_newsStatus;
	public function __construct(
		Context $context,
		Registry $registry,
		FormFactory $formFactory,
		Config $wysiwygConfig,
		array $data = []
	) {
		$this->_wysiwygConfig = $wysiwygConfig;
		parent::__construct($context, $registry, $formFactory, $data);
	}
	protected function _prepareForm(){
		$model = $this->_coreRegistry->registry('rma_item');
		$form = $this->_formFactory->create();
 
		$fieldset = $form->addFieldset(
			'base_fieldset',
			['legend' => __('General')]
		);
 
		if ($model->getId()) {
			$fieldset->addField(
				'rma_id',
				'hidden',
				['name' => 'rma_id']
			);
		}
		
		$fieldset->addField(
			'order_id',
			'text',
			[
				'name' => 'order_id',
				'label'	=> __('Order Id'),
				'required' => false
			]
		);
		

		$fieldset->addField(
			'customer_name',
			'text',
			[
				'name' => 'customer_name',
				'label'	=> __('Customer Name'),
				'required' => false
			]
		);

		
		
		
		$data = $model->getData();
		$form->setValues($data);
		$this->setForm($form);
 
		return parent::_prepareForm();
	}
	public function getTabLabel(){
		return __('Item');
	}
	public function getTabTitle(){
		return __('Item');
	}
	public function canShowTab(){
		return true;
	}
	public function isHidden(){
		return false;
	}
}