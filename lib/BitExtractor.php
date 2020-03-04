<?php
declare(strict_types=1);

namespace Kugaudo\Chmod;


class BitExtractor extends UniversalExtractor
{
    public function get(int $value, int $digit)
    {
        return $this->extract(2, $value, $digit);
    }
}
