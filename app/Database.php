<?php

namespace FpDbTest;

use Exception;
use mysqli;

class Database implements DatabaseInterface
{
    public final const PLACEHOLDER_PATTERN = '/\?d|\?f|\?a|\?#|\?\s/';
    public final const SKIP_PATTERN = '/\{.*SKIP.*\}/';
    public final const CURLY_PATTERN = '/\{|\}/';

    public function __construct(private readonly mysqli $mysqli, private readonly FormatterFactory $formatterFactory){}

    /**
     * @throws Exception
     */
    public function buildQuery(string $query, array $args = []): string
    {
        preg_match_all(self::PLACEHOLDER_PATTERN, $query, $matches);
        $markerList = $matches[0];
        if (count($markerList) === 0) {
            return $query;
        }

        $sqlParts = preg_split(self::PLACEHOLDER_PATTERN, $query, -1, PREG_SPLIT_NO_EMPTY);

        $newQuery = '';
        foreach ($sqlParts as $idx => $part) {
            if (isset($markerList[$idx]) && $args[$idx]) {
                $newQuery .= $part . $this->formatterFactory->getFormatterByMarker($markerList[$idx])->format($args[$idx]);
            } else {
                $newQuery .= $part;
            }
        }

        // Remove SKIP if exists
        $newQuery = preg_replace(self::SKIP_PATTERN, '', $newQuery);
        // Remove { and } if exists
        return preg_replace(self::CURLY_PATTERN, '', $newQuery);
    }

    public function skip()
    {
        return DefaultFormatter::SKIP;
    }
}
