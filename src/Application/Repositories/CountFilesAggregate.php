<?php


namespace App\Application\Repositories;


class CountFilesAggregate
{
    /** @var $countFiles int */
    private $sumOfCountFilesValues;

    public function __construct(int $sum)
    {
        $this->sumOfCountFilesValues = $sum;
    }

    public function __toString()
    {
        return (string)$this->sumOfCountFilesValues;
    }
}