<?php

namespace FpDbTest;
class FloatFormatter implements FormatterInterface
{
    public function format($value): string
    {
        return match (true) {
            $value === DefaultFormatter::SKIP => DefaultFormatter::SKIP,
            is_float($value) => (string)$value,
            is_null($value) => 'NULL',
            default => throw new \RuntimeException('Incorrect type value[' . gettype($value) . '], should be float.')
        };
    }
}