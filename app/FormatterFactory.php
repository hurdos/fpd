<?php

namespace FpDbTest;
use Exception;

class FormatterFactory
{
    public final const DEFAULT_MARKER = '? ';
    public final const DECIMAL_MARKER = '?d';
    public final const FLOAT_MARKER = '?f';
    public final const ARRAY_MARKER = '?a';
    public final const ID_MARKER = '?#';

    protected array $instances = [];

    /**
     * @throws Exception
     */
    public function getFormatterByMarker(string $marker): FormatterInterface
    {
        return match ($marker) {
            self::DEFAULT_MARKER => $this->getInstanceByMarker($marker, DefaultFormatter::class),
            self::DECIMAL_MARKER => $this->getInstanceByMarker($marker, DecimalFormatter::class),
            self::FLOAT_MARKER => $this->getInstanceByMarker($marker, FloatFormatter::class),
            self::ARRAY_MARKER => $this->getInstanceByMarker($marker, ArrayFormatter::class),
            self::ID_MARKER => $this->getInstanceByMarker($marker, IDFormatter::class),
            default => throw new Exception("Unexpected marker value [$marker]")
        };
    }

    protected function getInstanceByMarker(string $marker, string $class): FormatterInterface
    {
        if (!isset($this->instances[$marker])) {
            $this->instances[$marker] = new $class;
        }

        return $this->instances[$marker];
    }
}