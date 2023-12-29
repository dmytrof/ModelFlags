<?php

/*
 * This file is part of the DmytrofModelFlags package.
 *
 * (c) Dmytro Feshchenko <dmytro.feshchenko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmytrof\ModelFlags\Model;

interface ModelWithFlagsInterface
{
    /**
     * Sets flag
     * @param int|string $flag
     * @param bool $value
     * @return $this
     */
    public function setFlag(int|string $flag, bool $value = true): static;

    /**
     * Checks flag
     * @param int|string $flag
     * @return bool
     */
    public function hasFlag(int|string $flag): bool;

    /**
     * Pops flag
     * @param int|string $flag
     * @return bool
     */
    public function popFlag(int|string $flag): bool;

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     */
    public function unsetFlag(int|string $flag): static;

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     */
    public function removeFlag(int|string $flag): static;

    /**
     * Returns flags
     * @return array<int, int|string>
     */
    public function getFlags(): array;
}
