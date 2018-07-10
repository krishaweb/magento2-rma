<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Krishaweb\Rma\Model\Config\Source;

/**
 * Backups types' source model for system configuration
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 * @api
 * @since 100.0.2
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Backup data
     *
     * @var \Magento\Backup\Helper\Data
     */
    protected $_backupData = null;

    /**
     * @param \Magento\Backup\Helper\Data $backupData
     */
    public function __construct(\Magento\Backup\Helper\Data $backupData)
    {
        $this->_backupData = $backupData;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        
        $backupTypes = array('processing'=>'Processing','complete'=>'Complete');
        return $backupTypes;
    }
}
