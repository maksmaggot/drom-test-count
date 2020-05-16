<?php

namespace App\Application\Contracts\Filesystem;


use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;
use App\Application\Contracts\Filesystem\Exception\FileOpenFailException;

interface Filesystem
{
    /**
     * Get the contents of a file.
     *
     * @param string $path
     * @return array
     *
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function getFileLinesOrFail($path): array;
}