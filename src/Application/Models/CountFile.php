<?php


namespace App\Application\Models;

class CountFile
{
    /** @var $path string */
    private $path;

    /** @var $data array */
    private $data;

    /**
     * CountFile constructor.
     * @param $path
     * @param $rawData
     */
    public function __construct(string $path, string $rawData)
    {
        $this->path = $path;
        $this->data = $this->parseCountable($rawData);
    }

    /**
     * @param string $rawData
     * @return array
     */
    private function parseCountable(string $rawData): array
    {
        preg_match_all('/-?\d+/', $rawData, $resultArr);
        return array_map('intval', $resultArr[0]);
    }

    /**
     * @return int
     */
    public function getCountValuesSum()
    {
        return array_sum($this->data);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}