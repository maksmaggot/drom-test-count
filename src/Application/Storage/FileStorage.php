<?php

namespace App\Application\Storage;


interface FileStorage
{
    /**
     * @param $path
     * @return string
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function getRawFileDataByPath($path): string;

    /**
     * @param string $path
     * @return array
     * @throws \UnexpectedValueException
     */
    public function getCountableFilesPaths(string $path): array;
}