<?php


namespace App\Application\Contracts\Data;


interface DataReader
{
    /**
     * @param string $sourcePath
     * @return array
     */
    public function read(string $sourcePath): array;
}