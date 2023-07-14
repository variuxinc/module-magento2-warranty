<?php

namespace Variux\Warranty\Block\Adminhtml\WarrantyTransfer\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ApproveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Approve'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getApproveUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getApproveUrl()
    {
        return $this->getUrl('*/*/approve', ['id' => $this->getId()]);
    }
}
