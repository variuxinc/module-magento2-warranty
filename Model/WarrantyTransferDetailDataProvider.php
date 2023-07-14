<?php

namespace Variux\Warranty\Model;

use Variux\Warranty\Model\ResourceModel\WarrantyTransfer\CollectionFactory;

class WarrantyTransferDetailDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;

    protected $collection;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $warrantyTransferCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $warrantyTransferCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $warrantyTransferCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $warrantyTransfer) {
            if (!empty($warrantyTransfer->getData("file_path_json"))) {
                $filePathJson = json_decode($warrantyTransfer->getData("file_path_json"), true);
                if (is_array($filePathJson)) {
                    $result = "<ul>";
                    foreach ($filePathJson as $fileData) {
                        $result .= "
                                <li><a href='/media/warranty/transfer/" .
                                $fileData["file_path"] .
                                "' target='_blank'>" .
                                $fileData["file_name"] .
                                "</a></li>
                                ";
                    }
                    $result .= "</ul>";
                    $warrantyTransfer->setData("file_path_json", $result);
                } else {
                    $warrantyTransfer->setData("file_path_json", "");
                }
            }
            $this->_loadedData[$warrantyTransfer->getData("warrantytransfer_id")] = $warrantyTransfer->getData();
        }
        return $this->_loadedData;
    }
}
