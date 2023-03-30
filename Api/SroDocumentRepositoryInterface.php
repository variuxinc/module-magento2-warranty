<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SroDocumentRepositoryInterface
{

    /**
     * Save SroDocument
     * @param \Variux\Warranty\Api\Data\SroDocumentInterface $sroDocument
     * @return \Variux\Warranty\Api\Data\SroDocumentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Variux\Warranty\Api\Data\SroDocumentInterface $sroDocument
    );

    /**
     * Retrieve SroDocument
     * @param string $srodocumentId
     * @return \Variux\Warranty\Api\Data\SroDocumentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($srodocumentId);

    /**
     * Retrieve SroDocument matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Variux\Warranty\Api\Data\SroDocumentSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SroDocument
     * @param \Variux\Warranty\Api\Data\SroDocumentInterface $sroDocument
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Variux\Warranty\Api\Data\SroDocumentInterface $sroDocument
    );

    /**
     * Delete SroDocument by ID
     * @param string $srodocumentId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($srodocumentId);
}

