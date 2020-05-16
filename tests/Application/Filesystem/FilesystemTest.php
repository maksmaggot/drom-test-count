<?php


use App\Application\Contracts\Filesystem\Exception\FileNotFoundException;
use App\Application\Contracts\Filesystem\Exception\FileOpenFailException;
use App\Application\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    public function setUp(): void
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * @dataProvider additionReadProvider
     * @param $filepath
     * @param $expected
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function testGetFileLinesOrFail($filepath, $expected)
    {
        $this->assertSame($expected, $this->filesystem->getFileLinesOrFail($filepath));
    }

    public function additionReadProvider()
    {
        return [
            [
                __DIR__ . '/../../../testdata/count',
                ['4 22 42 -13 1b' . PHP_EOL, 'dsad 3 4 d6' . PHP_EOL, 'dadas 3 65 77']
            ],
            [
                __DIR__ . '/../../../testdata/project/count',
                ['some text data here' . PHP_EOL, '0 1 2 3']
            ],
            [
                __DIR__ . '/../../../testdata/static/count',
                []
            ]
        ];
    }

    /**
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function testExceptionNotFoundGetFileLinesOrFail()
    {
        $this->expectException(FileNotFoundException::class);
        $this->filesystem->getFileLinesOrFail('');
    }

    /**
     * @throws FileNotFoundException
     * @throws FileOpenFailException
     */
    public function testExceptionOpenFailGetFileLinesOrFail()
    {
        $this->expectException(FileOpenFailException::class);
        $this->filesystem->getFileLinesOrFail(__DIR__ . '/../../../testdata/locked',);
    }
}
