<?php
/**
 * User: zjkiza
 * Date: 4/23
 * Time: 09:0 AM.
 */

namespace App\Service;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;

class FileManager
{
    private $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public function uploadFile(UploadedFile $file): string
    {
        $fileName = sprintf('%s.%s', md5(uniqid('', true)), $file->extension());

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @param $file
     *
     * @return bool
     */
    public function removeFile($file): bool
    {
        $path = sprintf('%s/%s', $this->getTargetDirectory(), $file);

        $filesystem = new Filesystem();

        $filesystem->delete($path);

        return ! $filesystem->exists($path);
    }
}
