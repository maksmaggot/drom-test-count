<?php


namespace App\Commands;


use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;
use App\Application\Contracts\Filesystem\Exception\FileOpenFailException;
use App\Application\DataCounters\IntDataCounter;
use App\Application\DataReaders\IntFileReader;
use App\Application\Filesystem\Filesystem;
use UnexpectedValueException;

class SumCountCommand implements Command
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var IntFileReader
     */
    private $intFileReader;

    /**
     * @var IntDataCounter
     */
    private $intDataCounter;

    /** TODO DI */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->intFileReader = new IntFileReader($this->filesystem);
        $this->intDataCounter = new IntDataCounter();
    }

    /**
     * @param array $params
     */
    public function execute(array $params)
    {
        $path = $params[0];

        try {
            $filePaths = $this->filesystem->getCountableFilesPaths($path);

            $count = 0;
            foreach ($filePaths as $filePath) {
                $data = $this->intFileReader->read($filePath);
                $count += $this->intDataCounter->count($data);
            }
            echo "SumCount = " . $count . PHP_EOL;
        } catch (UnexpectedValueException $valueException) {
            echo "Error: path cannot be found or is not a directory";
        } catch (FileNotFoundException $fileNotFoundException) {
            echo "Error: " . $fileNotFoundException->getMessage();
        } catch (FileOpenFailException $fileOpenFailException) {
            echo "Error: " . $fileOpenFailException->getMessage();
        }
    }
}