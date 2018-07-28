<?php

/**
 * Class Calculator
 */
class Calculator
{
    /**
     * Суммирует числа.
     *
     * @TODO: Добавить поддержку отрицательных значений
     *
     * @return string
     */
    public function sum(): string
    {
        $argumentList = func_get_args();
        $this->validateArgumentList($argumentList);

        $result = '';
        $remain = 0;
        $iteration = 0;
        while (true) {
            $value = $remain;

            foreach ($argumentList as $argument) {
                $offset = mb_strlen($argument) - 1 - $iteration;

                if ($offset < 0) {
                    continue;
                }

                $value += $argument[$offset];
            }

            if (!$value) {
                break;
            }

            $value = (string) $value;
            $valueLastOffset = mb_strlen($value) - 1;

            $result .= $value[$valueLastOffset];
            $remain = (int) mb_substr($value, 0, $valueLastOffset);

            $iteration++;
        }

        return strrev($result);
    }

    /**
     * @param array $argumentList
     */
    protected function validateArgumentList(array $argumentList): void
    {
        if ($argumentList <= 1) {
            throw new \InvalidArgumentException('At least two parameters are expected');
        }
    }
}

$calc = new Calculator();
$result = $calc->sum(
    '1234567890',
    '123456',
    '12345678'
);

echo $result . PHP_EOL;