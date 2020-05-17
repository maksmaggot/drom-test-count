<?php


namespace App\Application\Filesystem;


class Reader implements Filesystem
{
    /**
     * @param $path
     * @return string
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getRawFileDataByPath($path): string
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("File does not exist at path {$path}.");
        }

        $content = @file_get_contents($path);
        if ($content === false) {
            throw new \RuntimeException("File open failed at path {$path}.");
        }

        return $content;
    }

    /**
     * @param string $path
     * @return array
     * @throws \UnexpectedValueException
     */
    public function getCountableFilesPaths(string $path): array
    {
        $countable = [];
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS),
        );

        /** @var $file \SplFileInfo */
        foreach ($files as $file) {
            if ($file->getFilename() === 'count') {
                $countable[] = $file->getRealPath();
            }
        }
        return $countable;
    }
}