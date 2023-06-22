<?php

namespace Variux\Warranty\Model\File;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Filesystem;
use Magento\Framework\Phrase;
use Magento\Framework\Api\Uploader;

class FileProcessor
{
    /**
     * @var array
     */
    protected $mimeTypeExtensionMap = [
        'image/jpg' => 'jpg',
        'image/jpeg' => 'jpg',
        'image/gif' => 'gif',
        'image/png' => 'png',
        'application/pdf' => 'pdf',
        'video/mp4' => 'mp4',
        'video/quicktime' => 'mov',
        'application/octet-stream' => 'rec'
    ];

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var Filesystem
     */
    private $contentValidator;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var Uploader
     */
    private $uploader;

    /**
     * @param Filesystem $fileSystem
     * @param FileValidate $contentValidator
     * @param \Psr\Log\LoggerInterface $logger
     * @param Uploader $uploader
     */
    public function __construct(
        Filesystem $fileSystem,
        FileValidate $contentValidator,
        \Psr\Log\LoggerInterface $logger,
        Uploader $uploader
    ) {
        $this->filesystem = $fileSystem;
        $this->contentValidator = $contentValidator;
        $this->logger = $logger;
        $this->uploader = $uploader;
    }

    /**
     * Proccess File Content
     *
     * @param string $entityType
     * @param array $fileContent
     * @return array
     * @throws InputException
     * @throws Exception
     */
    public function processFileContent($entityType, array $fileContent)
    {
        $validateResult = $this->contentValidator->isValid($fileContent);
        if ($validateResult["result"]) {
            $fileAttributes = [
                'tmp_name' => $fileContent["tmp_name"],
                'name' => $fileContent["name"]
            ];
            try {
                $this->uploader->processFileAttributes($fileAttributes);
                $this->uploader->setFilesDispersion(true);
                $this->uploader->setFilenamesCaseSensitivity(false);
                $this->uploader->setAllowRenameFiles(true);
                $destinationFolder = $entityType;
                $this->uploader
                     ->save($this->filesystem
                                 ->getDirectoryWrite(DirectoryList::MEDIA)
                                 ->getAbsolutePath($destinationFolder), $fileContent["name"]);
            } catch (Exception $e) {
                $this->logger->critical($e);
                throw $e;
            }
            return ["file_path" => $this->uploader->getUploadedFileName(), "file_mime" => $validateResult["file_mime"]];
        } else {
            throw new InputException(new Phrase($validateResult["error"]));
        }
    }
}
