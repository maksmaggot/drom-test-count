<?php


namespace App\Application\Filesystem;


use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;
use App\Application\Contracts\Filesystem\Exception\FileOpenFailException;
use UnexpectedValueException;

class Filesystem implements \App\Application\Contracts\Filesystem\Filesystem
{
    /**
     * @param string $path
     * @return array
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function getFileLinesOrFail($path): array
    {
        if (!file_exists($path)) {
            throw new FileNotFoundException("File does not exist at path {$path}.");
        }

        $lines = @file($path, FILE_SKIP_EMPTY_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            throw new FileOpenFailException("File open failed at path {$path}.");
        }

        return $lines;
    }

    /**
     * @param string $path
     * @return array
     * @throws UnexpectedValueException
     */
    public function getCountableFilesPaths(string $path): array
    {
        $countable = [];
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
        );

        /** @var $file \SplFileInfo */
        foreach ($files as $file) {
            if ($file->getFilename()  === 'count'){
                $countable[] = $file->getRealPath();
            }
        }
        return $countable;
    }
}