<?php

/*
 * This file is part of the DmytrofModelFlags package.
 *
 * (c) Dmytro Feshchenko <dmytro.feshchenko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmytrof\ModelFlags\Tests\Model\Traits;

use Dmytrof\ModelFlags\Model\ModelWithFlagsInterface;
use Dmytrof\ModelFlags\Model\Traits\ModelWithFlagsTrait;
use PHPUnit\Framework\TestCase;

class ModelWithFlagsTraitTest extends TestCase
{
    public function testSupportedFlagsTypes(): void
    {
        $modelWithFlags = new class implements ModelWithFlagsInterface {
            use ModelWithFlagsTrait;

            public const SOME_FLAG1 = 1;
            public const SOME_FLAG2 = 'FLAG_2';
        };

        $this->assertFalse($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG2));

        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG2));

        $this->assertInstanceOf(get_class($modelWithFlags), $modelWithFlags->setFlag($modelWithFlags::SOME_FLAG1));

        $this->assertEquals([
            $modelWithFlags::SOME_FLAG1 => true,
        ], $modelWithFlags->getFlags());

        $this->assertTrue($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG2));

        $this->assertTrue($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG2));

        $this->assertEquals([], $modelWithFlags->getFlags());

        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG2));

        $this->assertInstanceOf(get_class($modelWithFlags), $modelWithFlags->setFlag($modelWithFlags::SOME_FLAG2));

        $this->assertEquals([
            $modelWithFlags::SOME_FLAG2 => true,
        ], $modelWithFlags->getFlags());

        $this->assertFalse($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG1));
        $this->assertTrue($modelWithFlags->hasFlag($modelWithFlags::SOME_FLAG2));

        $this->assertInstanceOf(get_class($modelWithFlags), $modelWithFlags->unsetFlag($modelWithFlags::SOME_FLAG2));

        $this->assertEquals([], $modelWithFlags->getFlags());

        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG1));
        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG2));

        $this->assertInstanceOf(get_class($modelWithFlags), $modelWithFlags->setFlag($modelWithFlags::SOME_FLAG1, false));
        $this->assertEquals([
            $modelWithFlags::SOME_FLAG1 => false,
        ], $modelWithFlags->getFlags());
        $this->assertFalse($modelWithFlags->popFlag($modelWithFlags::SOME_FLAG1));
    }
}
