<?php

namespace FpDbTest;
class DefaultFormatter implements FormatterInterface
{
    public function format($value): string
    {
        return match (true) {
            is_string($value) => $this->escapeString($value),
            is_int($value), is_float($value) => (string)$value,
            is_bool($value) => $value ? '1' : '0',
            is_null($value) => 'NULL',
            default => throw new \RuntimeException('Incorrect type value[' . gettype($value) . ']')
        };
    }

    protected function escapeString(string $value): string
    {
        return '\'' . $value . '\' ';
    }
}