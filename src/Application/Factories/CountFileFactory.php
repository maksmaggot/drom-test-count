<?php


namespace App\Application\Factories;


use App\Application\Storage\FileStorage;
use App\Application\Models\CountFile;

class CountFileFactory
{
    /**
     * @var FileStorage
     */
    private $reader;

    /**
     * CountFileFactory constructor.
     * @param FileStorage $reader
     */
    public function __construct(FileStorage $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @param string $path
     * @return CountFile
     */
    public function build(string $path): CountFile
    {
        return new CountFile($path, $this->reader->getRawFileDataByPath($path));
    }
}