<?php

namespace Tests\Application\DataReader;

use App\Application\DataReaders\IntFileReader;
use App\Application\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

class IntFileReaderTest extends TestCase
{
    /**
     * @dataProvider additionReadProvider
     * @param string $filePath
     * @param array $fileLines
     * @param array $expected
     * @throws \App\Application\Filesystem\Exception\FileNotFoundException
     */
    public function testRead(string $filePath, array $fileLines, array $expected)
    {
        $mockFilesystem = $this->createMock(Filesystem::class);
        $mockFilesystem->method('getFileLinesOrFail')->will($this->returnValue($fileLines));
        $intFileReader = new IntFileReader($mockFilesystem);

        $this->assertSame($expected, $intFileReader->read($filePath));
    }

    public function additionReadProvider()
    {
        return [
            [
                __DIR__ . '/../../../testdata/count',
                ['4 22 42 -13 1b' . PHP_EOL, 'dsad 3 4 d6' . PHP_EOL, 'dadas 3 65 77'],
                [4, 22, 42, -13, 3, 4, 3, 65, 77]
            ],
            [
                __DIR__ . '/../../../testdata/project/count',
                ['some text data here' . PHP_EOL, '0 1 2 3'],
                [0, 1, 2, 3]
            ]
        ];
    }
}
