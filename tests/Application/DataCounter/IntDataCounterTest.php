<?php

namespace Tests\Application\DataCounter;

use App\Application\DataCounters\IntDataCounter;
use PHPUnit\Framework\TestCase;

class IntDataCounterTest extends TestCase
{

    /**
     * @var IntDataCounter
     */
    private $intDataCounter;

    protected function setUp(): void
    {
        $this->intDataCounter = new IntDataCounter();
    }

    /**
     * @dataProvider additionCountProvider
     * @param array $arr
     * @param int $expected
     */
    public function testCount(array $arr, int $expected)
    {
        $this->assertSame($expected, $this->intDataCounter->count($arr));
    }

    public function additionCountProvider()
    {
        return [
            [[1, 2, 3], 6],
            [[0, 2, 3], 5]
        ];
    }
}
