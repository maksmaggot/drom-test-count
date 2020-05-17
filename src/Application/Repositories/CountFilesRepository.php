<?php


namespace App\Application\Repositories;


use app\Application\Models\CountFile;

class CountFilesRepository
{
    /**
     * @var CountFile[]
     */
    private $files = [];

    /**
     * @param CountFile $file
     */
    public function add(CountFile $file)
    {
        $this->files[] = $file;
    }

    public function getCountFilesAggregate(): CountFilesAggregate
    {
        $sum = 0;
        foreach ($this->files as $file) {
            $sum += $file->getCountValuesSum();
        }

        return new CountFilesAggregate($sum);
    }
}