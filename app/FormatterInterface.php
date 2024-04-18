<?php

namespace FpDbTest;
interface FormatterInterface
{
    public function format($value): string;
}
