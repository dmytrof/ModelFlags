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

use Dmytrof\ModelFlags\Exception\InvalidFlagException;
use Dmytrof\ModelFlags\Model\ModelWithFlagsInterface;

trait ModelWithFlagsTrait
{
    protected array $flags = [];

    /**
     * Sets flag
     * @param int|string $flag
     * @param bool $value
     * @return ModelWithFlagsInterface
     * @see ModelWithFlagsInterface::setFlag()
     */
    public function setFlag($flag, bool $value = true): ModelWithFlagsInterface
    {
        $this->checkFlagType($flag);
        $this->flags[$flag] = $value;

        return $this;
    }

    /**
     * Checks flag
     * @param int|string $flag
     * @return bool
     * @see ModelWithFlagsInterface::hasFlag()
     */
    public function hasFlag($flag): bool
    {
        $this->checkFlagType($flag);

        return $this->flags[$flag] ?? false;
    }

    /**
     * Pops flag
     * @param int|string $flag
     * @return bool
     * @see ModelWithFlagsInterface::popFlag()
     */
    public function popFlag($flag): bool
    {
        $flagValue = $this->hasFlag($flag);
        $this->unsetFlag($flag);

        return $flagValue;
    }

    /**
     * Unsets flag
     * @param int|string $flag
     * @return ModelWithFlagsInterface
     * @see ModelWithFlagsInterface::unsetFlag()
     */
    public function unsetFlag($flag): ModelWithFlagsInterface
    {
        $this->checkFlagType($flag);
        unset($this->flags[$flag]);

        return $this;
    }

    /**
     * Unsets flag
     * @param int|string $flag
     * @return ModelWithFlagsInterface
     * @see ModelWithFlagsInterface::removeFlag()
     */
    public function removeFlag($flag): ModelWithFlagsInterface
    {
        return $this->unsetFlag($flag);
    }

    /**
     * Returns flags
     * @return array
     * @see ModelWithFlagsInterface::getFlags()
     */
    public function getFlags(): array
    {
        return $this->flags;
    }

    /**
     * Checks type of flag
     * @param $flag
     * @return bool
     */
    protected function checkFlagType($flag): bool
    {
        if (!is_int($flag) && !is_string($flag)) {
            throw new InvalidFlagException(sprintf('Unsupported type \'%s\' of flag. Strings and integers are supported only!', gettype($flag)));
        }

        return true;
    }
}
