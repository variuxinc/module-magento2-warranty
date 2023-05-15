<?php

namespace Variux\Warranty\Model\File;

use finfo;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Phrase;

/**
 * Class for File content validation
 */
class FileValidate
{
    protected $_helperData;
    /**
     * @var array
     */
    private $defaultMimeTypes = [
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/png',
        'application/pdf',
        'application/octet-stream',
        'video/mp4',
        'video/quicktime'
    ];

    /**
     * @var array
     */
    private $allowedMimeTypes;

    /**
     * @param array $allowedMimeTypes
     */
    public function __construct(
        \Variux\Warranty\Helper\Data $helperData,
        array $allowedMimeTypes = []
    ) {
        $this->_helperData = $helperData;
        $this->allowedMimeTypes = array_merge($this->defaultMimeTypes, $allowedMimeTypes);
    }

    /**
     * Check if file entry content is valid
     *
     * @param array $fileContent
     * @return array
     * @throws InputException
     */
    public function isValid(array $fileContent)
    {
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);

        $sourceMimeType = $fileInfo->file($fileContent["tmp_name"]);
        if (!$this->isMimeTypeValid($sourceMimeType)) {
            return ["result" => false, "file_mime" => null, "error" => "The file MIME type \"$sourceMimeType\" is not valid or not supported."];
        }
        if (!$this->isNameValid($fileContent["name"])) {
            return ["result" => false, "file_mime" => null, "error" => "Provided file name contains forbidden characters."];
        }

        if (!$this->isValidSize($fileContent["size"])) {
            return ["result" => false, "file_mime" => null, "error" => "Size of file must be less than " . $this->getMaxFileSize() . "MB"];
        }
        return ["result" => true, "file_mime" => $sourceMimeType, "error" => null];
    }

    /**
     * Check if given mime type is valid
     *
     * @param string $mimeType
     * @return bool
     */
    protected function isMimeTypeValid($mimeType)
    {
        return in_array($mimeType, $this->allowedMimeTypes);
    }

    /**
     * Check if given filename is valid
     *
     * @param string $name
     * @return bool
     */
    protected function isNameValid($name)
    {
        // Cannot contain \ / : * ? " < > |
        if (!preg_match('/^[^\\/?*:";<>()|{}\\\\]+$/', $name)) {
            return false;
        }
        return true;
    }

    /**
     * @return boolean
     */
    private function isValidSize($size)
    {
        return $size <= $this->getMaxFileSize()*1048576;
    }

    /**
     * @return number
     */
    public function getMaxFileSize()
    {
        return $this->_helperData->getMaxFileSize();
    }
}
