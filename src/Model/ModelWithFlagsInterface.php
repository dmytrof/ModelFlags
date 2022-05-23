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

use Dmytrof\ModelFlags\Model\Traits\ModelWithFlagsTrait;

interface ModelWithFlagsInterface
{
    /**
     * Sets flag
     * @param int|string $flag
     * @param bool $value
     * @return $this
     */
    public function setFlag($flag, bool $value = true): self;

    /**
     * Checks flag
     * @param int|string $flag
     * @return bool
     */
    public function hasFlag($flag): bool;

    /**
     * Pops flag
     * @param int|string $flag
     * @return bool
     */
    public function popFlag($flag): bool;

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     */
    public function unsetFlag($flag): self;

    /**
     * Unsets flag
     * @param int|string $flag
     * @return $this
     */
    public function removeFlag($flag): self;

    /**
     * Returns flags
     * @return array
     */
    public function getFlags(): array;
}
