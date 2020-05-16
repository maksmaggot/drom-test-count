<?php


namespace App\Application\DataCounters;


use App\Application\Contracts\Data\DataCounter;

class IntDataCounter implements DataCounter
{
    /**
     * @param array $data
     * @return int
     */
    public function count(array $data): int
    {
        return array_sum($data);
    }
}