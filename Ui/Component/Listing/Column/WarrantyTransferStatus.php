<?php

namespace Variux\Warranty\Ui\Component\Listing\Column;

class WarrantyTransferStatus extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $status = $item['status'];
                $result = "Waiting for approval";
                if ($status == \Variux\Warranty\Api\Data\WarrantyTransferInterface::STATUS_APPROVED) {
                    $result = "Approved";
                }
                if ($status == \Variux\Warranty\Api\Data\WarrantyTransferInterface::STATUS_REJECTED) {
                    $result = "Rejected";
                }
                $item[$this->getData('name')] = $result;
            }
        }
        return $dataSource;
    }
}
