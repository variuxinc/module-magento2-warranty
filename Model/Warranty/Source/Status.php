<?php

namespace Variux\Warranty\Model\Warranty\Source;

class Status implements \Magento\Framework\Option\ArrayInterface
{

    /**
     * @return array[]
     */
    public function toOptionArray(): array
    {
        return $this->getStatusArray();
    }

    /**
     * @return array[]
     */
    private function getStatusArray(): array
    {
        return array(
            ['value' => 'CD', 'label' => 'Claim Denied'],
            ['value' => 'CMIssued', 'label' => 'Credit Memo Issued'],
            ['value' => 'CSAprv', 'label' => 'Customer Service Approval'],
            ['value' => 'CSREVIEW', 'label' => 'CUSTOMER SERVICE REVIEW'],
            ['value' => 'EngInpt', 'label' => 'Engineering  Input'],
            ['value' => 'INCOMP', 'label' => 'Incomplete Claim'],
            ['value' => 'Info', 'label' => 'Memo Info Only'],
            ['value' => 'InProc', 'label' => 'In Process'],
            ['value' => 'MgmtAprv', 'label' => 'Management Approval'],
            ['value' => 'NewCont', 'label' => 'Submitted'],
            ['value' => 'PrtsInsptd', 'label' => 'Parts Inspected'],
            ['value' => 'PrtsRtnd', 'label' => 'Parts Returned'],
            ['value' => 'SOEntered', 'label' => 'Sales Order Entered'],
            ['value' => 'TRBLRESOLV', 'label' => 'Trouble Resolved'],
            ['value' => 'TRBLSHOOT', 'label' => 'Trouble Shooting'],
            ['value' => 'VS-CMPLT', 'label' => 'VENDOR SHIP COMPLETED'],
            ['value' => 'VS-Denied', 'label' => 'Vendor Ship Denied'],
            ['value' => 'VS-INPROC', 'label' => 'VENDOR SHIP IN PROCESS'],
            ['value' => 'VS-Ship', 'label' => 'Vendor Return Shipped'],
            ['value' => 'WtngPrts', 'label' => 'Waiting for Parts']
        );
    }
}
