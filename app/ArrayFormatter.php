<?php

namespace FpDbTest;
class ArrayFormatter extends DefaultFormatter
{
    public function format($value): string
    {
        if ($value === DefaultFormatter::SKIP) {
            return DefaultFormatter::SKIP;
        }

        if (!is_array($value)) {
            throw new \RuntimeException('Incorrect type value[' . gettype($value) . '], should be array');
        }

        $result = [];
        foreach ($value as $key => $val) {
            if (is_string($key)) {
                $result[] = $this->escapeID($key) . ' = ' . parent::format($val);
            } else {
                $result[] = parent::format($val);
            }
        }
        return implode(', ', $result);
    }

    protected function escapeID(string $value): string
    {
        return '`' . $value . '`';
    }

    protected function escapeString(string $value): string
    {
        return '\'' . $value . '\'';
    }
}