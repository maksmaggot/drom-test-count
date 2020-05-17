<?php


namespace App\Application\Factories;


use App\Application\Filesystem\Filesystem;
use App\Application\Models\CountFile;

class CountFileFactory
{
    /**
     * @var Filesystem
     */
    private $reader;

    /**
     * CountFileFactory constructor.
     * @param Filesystem $reader
     */
    public function __construct(Filesystem $reader)
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