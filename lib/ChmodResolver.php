<?php
declare(strict_types=1);

namespace Kugaudo\Chmod;

/**
 * Class ChmodResolver
 * @package Kugaudo\Chmod
 *
 * @see https://www.howtogeek.com/437958/how-to-use-the-chmod-command-on-linux/ for more info
 */
class ChmodResolver
{
    public const WHO_OWNER  = 'u';
    public const WHO_GROUP  = 'g';
    public const WHO_OTHERS = 'o';

    public const OP_READ    = 'r';
    public const OP_WRITE   = 'w';
    public const OP_EXECUTE = 'x';

    private const MODE_WHO_DIGIT = [
        'o' => 0,
        'g' => 1,
        'u' => 2,
    ];

    private const MODE_OP_BIT = [
        'x' => 0,
        'w' => 1,
        'r' => 2,
    ];

    /** @var DigitExtractor */
    private $digitExtractor;

    /** @var BitExtractor */
    private $bitExtractor;

    /**
     * ChmodResolver constructor.
     */
    public function __construct()
    {
        $this->digitExtractor = new DigitExtractor();
        $this->bitExtractor = new BitExtractor();
    }

    public function of(int $mode, string $who, string $op): ChmodResolverResult
    {
        if ($mode < 0) {
            return new ChmodResolverResult(false,
                sprintf('Invalid mode: non-negative integer expected, [%d] given', $mode));
        }
        if (!in_array($who, [self::WHO_OWNER, self::WHO_GROUP, self::WHO_OTHERS])) {
            return new ChmodResolverResult(false,
                sprintf('Invalid "who": one of "%s|%s|%s" expected, [%s] given',
                    self::WHO_OWNER, self::WHO_GROUP, self::WHO_OTHERS, $who));
        }
        if (!in_array($op, [self::OP_READ, self::OP_WRITE, self::OP_EXECUTE])) {
            return new ChmodResolverResult(false,
                sprintf('Invalid "op": one of "%s|%s|%s" expected, [%s] given',
                    self::OP_READ, self::OP_WRITE, self::OP_EXECUTE, $op));
        }

        $digit = self::MODE_WHO_DIGIT[$who];
        if (!isset($digit)) {
            throw new \LogicException('Should never happen');
        }

        $bit = self::MODE_OP_BIT[$op];
        if (!isset($bit)) {
            throw new \LogicException('Should never happen');
        }

        $value = $this->digitExtractor->get($mode, $digit);

        return new ChmodResolverResult(
            $this->bitExtractor->get($value, $bit) === 1);
    }
}
