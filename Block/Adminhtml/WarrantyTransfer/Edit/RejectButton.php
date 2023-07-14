<?php

namespace Variux\Warranty\Block\Adminhtml\WarrantyTransfer\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class RejectButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Reject'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getRejectUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getRejectUrl()
    {
        return $this->getUrl('*/*/reject', ['id' => $this->getId()]);
    }
}
