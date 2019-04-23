<?php
/**
 * Created by PhpStorm.
 * User: kiza
 * Date: 4/23
 * Time: 09:0 AM
 */

namespace App\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Filesystem\Filesystem;

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
     * @return string
     */
    public function uploadFile(UploadedFile $file):string
    {
        $fileName = sprintf('%s.%s', md5(uniqid('', true)), $file->extension());

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @param $file
     * @return bool
     */
    public function removeFile($file):bool
    {
        $path = sprintf('%s/%s', $this->getTargetDirectory(), $file);

        $fs = new Filesystem();

        $fs->delete($path);

        return !$fs->exists($path);
    }
}