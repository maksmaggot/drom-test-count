<?php


namespace App\Application\DataReaders;


use App\Application\Contracts\Data\DataReader;
use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;
use App\Application\Contracts\Filesystem\Exception\FileOpenFailException;
use App\Application\Contracts\Filesystem\Filesystem;

class IntFileReader implements DataReader
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * IntFileReader constructor.
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $sourcePath
     * @return array
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function read(string $sourcePath): array
    {
        $lines = $this->filesystem->getFileLinesOrFail($sourcePath);

        $result = [];
        foreach ($lines as $line) {
            $filteredLine = array_filter(explode(' ', $line),'is_numeric');
            $result = array_merge($result, array_map('intval', $filteredLine));
        }
        return $result;
    }
}