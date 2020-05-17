<?php

namespace Tests\Application\Models;

use App\Application\Models\CountFile;
use PHPUnit\Framework\TestCase;

class CountFileTest extends TestCase
{

    /**
     * @dataProvider rawDataProvider
     * @param string $rawdata
     * @param array $expected
     */
    public function testParseCountable(string $rawdata, array $expected)
    {
        $countable = new CountFile('path', $rawdata);
        $this->assertSame($expected, $countable->getData());
    }

    public function rawDataProvider()
    {
        return [
            ['a 1 2 bs 2 3', [1, 2, 2, 3]],
            ['1-2
            -3', [1, -2, -3]],
        ];
    }


}
