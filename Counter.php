<?php

/**
 * Class Counter
 */
class Counter
{
    protected const DEFAULT_COUNTER_PATH = '.';

    /** @var string */
    protected $path;

    /** @var string */
    protected $name;

    /** @var int */
    protected $value;

    /**
     * Counter constructor.
     * @param string $counterName
     * @param string $counterPath
     */
    public function __construct(string $counterName, string $counterPath = self::DEFAULT_COUNTER_PATH)
    {
        $this->name = $counterName;
        $this->path = $counterPath;
    }

    /**
     * Увеличивает значение счетчика
     *
     * @param int $value
     */
    public function increment(int $value = 1): void
    {
        $filePath = $this->getFilePath();

        if (!file_exists($filePath)) {
            touch($filePath);
        }

        file_put_contents($filePath, $value, FILE_APPEND);
    }

    /**
     * Возвращает актуальное значение счетчика
     *
     * @return int
     */
    public function read(): int
    {
        $result = 0;

        $filePath = $this->getFilePath();

        if (file_exists($filePath)) {
            $data = file_get_contents($filePath);
            if ($data !== false) {
                for ($i = 0; $i < mb_strlen($data); $i++) {
                    $result += (int) $data[$i];
                }
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function getFilePath(): string
    {
        return sprintf('%s/%s', $this->path, $this->name);
    }
}

$counter = new Counter('counter.txt');
$counter->increment();
$counter->increment(3);
$counter->read();