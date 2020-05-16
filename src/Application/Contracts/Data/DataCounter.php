<?php


namespace App\Application\Contracts\Data;


interface DataCounter
{
    /**
     * @param array $data
     * @return int
     */
    public function count(array $data): int;
}