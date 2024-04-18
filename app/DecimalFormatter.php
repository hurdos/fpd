<?php

namespace FpDbTest;

class DecimalFormatter implements FormatterInterface
{
    public function format($value): string
    {
        return match (true) {
            is_int($value) => (string)$value,
            // в ТЗ о том, что ?d может принимать bool нет, но в тестах оно есть
            is_bool($value) => $value ? '1' : '0',
            is_null($value) => 'NULL',
            default => throw new \RuntimeException('Incorrect type value[' . gettype($value) . '], should be integer.')
        };
    }
}