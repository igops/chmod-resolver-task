<?php
declare(strict_types=1);

namespace Kugaudo\Chmod;


class ChmodResolverResult
{
    /** @var bool */
    private $matches;

    /** @var string|null */
    private $errorMessage = null;

    /**
     * ChmodResolverResult constructor.
     * @param bool $matches
     * @param string|null $errorMessage
     */
    public function __construct(bool $matches, ?string $errorMessage = null)
    {
        $this->matches = $matches;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return bool
     */
    public function matches(): bool
    {
        return $this->matches;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
