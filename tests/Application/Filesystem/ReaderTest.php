<?php

namespace Tests\Application\Filesystem;

use App\Application\Filesystem\Reader;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    /**
     * @var Reader
     */
    private $filesystem;

    protected function setUp(): void
    {
        $this->filesystem = new Reader();
    }

    /**
     * @dataProvider pathDataProvider
     * @param string $path
     * @param string $expected
     */
    public function testGetRawFileDataByPath(string $path, string $expected)
    {
        $this->assertSame($expected, $this->filesystem->getRawFileDataByPath($path));
    }

    public function pathDataProvider()
    {
        return [
            [
                __DIR__ . '/../../../testdata/count',
                '4 22 42-13 1b
dsad 3 4 d6
dadas 3 65 77'
            ],
            [
                __DIR__ . '/../../../testdata/project/count',
                'some text data here
0 1 2 3
3 1'
            ],
            [
                __DIR__ . '/../../../testdata/static/count',
                ''
            ]
        ];

    }

    public function testExceptionGetRawFileDataByPath()
    {
        $this->expectException(\RuntimeException::class);
        $this->filesystem->getRawFileDataByPath(__DIR__ . '/../../../testdata/locked');
    }

    /**
     * @dataProvider pathsDataProvider
     * @param $expected
     */
    public function testGetCountableFilesPaths(array $expected)
    {
        $this->assertSame($expected, $this->filesystem->getCountableFilesPaths(__DIR__ . '/../../../testdata/'));
    }

    public function pathsDataProvider()
    {
        return [
            [
                [
                    '/var/www/testdata/project/count',
                    '/var/www/testdata/static/count',
                    '/var/www/testdata/count'
                ],
            ],
        ];
    }


}
