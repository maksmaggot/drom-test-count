<?php


namespace App\Commands;


use App\Application\Factories\CountFileFactory;
use App\Application\Filesystem\Reader;
use App\Application\Repositories\CountFilesRepository;

class SumCountCommand implements Command
{
    /**
     * @var Reader
     */
    private $filesystem;

    /**
     * @var CountFilesRepository
     */
    private $repository;

    /** TODO DI */
    public function __construct()
    {
        $this->filesystem = new Reader();
        $this->repository = new CountFilesRepository();
    }

    /**
     * @param array $params
     */
    public function execute(array $params)
    {
        $path = $params[0];

        try {
            $filePaths = $this->filesystem->getCountableFilesPaths($path);

            $factory = new CountFileFactory($this->filesystem);
            foreach ($filePaths as $filePath) {
                $this->repository->add($factory->build($filePath));
            }

            echo "SumCount = " . $this->repository->getCountFilesAggregate() . PHP_EOL;
        } catch (\UnexpectedValueException $valueException) {
            echo "Error: path cannot be found or is not a directory" . $valueException->getMessage();
        } catch (\InvalidArgumentException $invalidArgumentException) {
            echo "Error: " . $invalidArgumentException->getMessage();
        } catch (\RuntimeException $runtimeException) {
            echo "Error: " . $runtimeException->getMessage();
        }
    }
}