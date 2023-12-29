<?php

/*
 * This file is part of the DmytrofModelFlags package.
 *
 * (c) Dmytro Feshchenko <dmytro.feshchenko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmytrof\ModelFlags\Model\Traits;

use Dmytrof\ModelFlags\Model\ModelWithFlagsInterface;

trait ModelWithFlagsTrait
{
    protected array $flags = [];

    /**
     * Sets flag
     * @param int|string $flag
     * @param bool $value
     * @return $this
     * @see ModelWithFlagsInterface::setFlag()
     */
    public function setFlag(int|string $flag, bool $value = true): static
    {
        $this->flags[$flag] = $value;

        return $this;
    }

    /**
     * Checks flag
     * @param int|string $flag
     * @return bool
     * @see ModelWithFlagsInterface::hasFlag()
     */
    public function hasFlag(int|string $flag): bool
    {
        return $this->flags[$flag] ?? false;
    }

    /**
     * Pops flag
     * @param int|string $flag
     * @return bool
     * @see ModelWithFlagsInterface::popFlag()
     */
    public function popFlag(int|string $flag): bool
    {
        $flagValue = $this->hasFlag($flag);
        $this->unsetFlag($flag);

        return $flagValue;
    }

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     * @see ModelWithFlagsInterface::unsetFlag()
     */
    public function unsetFlag(int|string $flag): static
    {
        unset($this->flags[$flag]);

        return $this;
    }

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     * @see ModelWithFlagsInterface::removeFlag()
     */
    public function removeFlag(int|string $flag): static
    {
        $this->unsetFlag($flag);

        return $this;
    }

    /**
     * Returns flags
     * @return array<int, int|string>
     * @see ModelWithFlagsInterface::getFlags()
     */
    public function getFlags(): array
    {
        return $this->flags;
    }
}
