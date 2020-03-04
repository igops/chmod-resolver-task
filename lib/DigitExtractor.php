<?php
declare(strict_types=1);

namespace Kugaudo\Chmod;


class DigitExtractor extends UniversalExtractor
{
    public function get(int $value, int $digit)
    {
        return $this->extract(10, $value, $digit);
    }
}
