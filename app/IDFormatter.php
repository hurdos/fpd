<?php

namespace FpDbTest;
class IDFormatter implements FormatterInterface
{
    public function format($value): string
    {
        if ($value === DefaultFormatter::SKIP) {
            return DefaultFormatter::SKIP;
        }

        if (!is_array($value)) {
            $value = [$value];
        }

        $value = array_map(function (string $item): string
        {
            return $this->escapeString($item);
        }, $value);

        return implode(', ', $value);
    }

    protected function escapeString(string $value): string
    {
        return '`' . $value . '`';
    }
}