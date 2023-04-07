<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Variux\Warranty\Api\Data;

interface SroDocumentInterface
{

    const TYPE = 'type';
    const NAME = 'name';
    const SRO_ID = 'sro_id';
    const UPDATED_AT = 'updated_at';
    const DESCRIPTION = 'description';
    const SRODOCUMENT_ID = 'srodocument_id';
    const CREATED_AT = 'created_at';
    const FILE_PATH = 'file_path';

    /**
     * Get srodocument_id
     * @return string|null
     */
    public function getSrodocumentId();

    /**
     * Set srodocument_id
     * @param string $srodocumentId
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setSrodocumentId($srodocumentId);

    /**
     * Get sro_id
     * @return string|null
     */
    public function getSroId();

    /**
     * Set sro_id
     * @param string $sroId
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setSroId($sroId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setName($name);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setDescription($description);

    /**
     * Get file_path
     * @return string|null
     */
    public function getFilePath();

    /**
     * Set file_path
     * @param string $filePath
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setFilePath($filePath);

    /**
     * Get type
     * @return string|null
     */
    public function getType();

    /**
     * Set type
     * @param string $type
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setType($type);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Variux\Warranty\SroDocument\Api\Data\SroDocumentInterface
     */
    public function setUpdatedAt($updatedAt);
}
