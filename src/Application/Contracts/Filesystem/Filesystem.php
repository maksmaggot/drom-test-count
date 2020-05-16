<?php

namespace App\Application\Contracts\Filesystem;


use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;

interface Filesystem
{
    /**
     * Get the contents of a file.
     *
     * @param string $path
     * @return array
     *
     * @throws FileNotFoundException
     */
    public function getFileLinesOrFail($path): array;
}