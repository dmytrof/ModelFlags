<?php

/*
 * This file is part of the DmytrofModelsManagementBundle package.
 *
 * (c) Dmytro Feshchenko <dmytro.feshchenko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmytrof\ModelFlags\Tests\Model\Traits;

use Dmytrof\ModelFlags\Exception\InvalidFlagException;
use Dmytrof\ModelFlags\Model\Traits\ModelWithFlagsTrait;
use PHPUnit\Framework\TestCase;

class ModelWithFlagsTraitTest extends TestCase
{
    public function testSupportedFlagsTypes(): void
    {
        $modelWithFlags = new class {
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

    public function testArrayFlagsTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;

            public const UNSUPPORTED_FLAG = ['ARRAY_FLAG'];
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->setFlag($modelWithFlags::UNSUPPORTED_FLAG);

    }

    public function testBooleanFlagTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->hasFlag(true);
    }

    public function testBooleanFalseFlagTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->popFlag(false);
    }

    public function testNullFlagTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->unsetFlag(null);
    }

    public function testObjectFlagTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->removeFlag((object) []);
    }

    public function testFloatFlagTypes(): void
    {
        $modelWithFlags = new class {
            use ModelWithFlagsTrait;
        };

        $this->expectException(InvalidFlagException::class);
        $modelWithFlags->hasFlag(3.14);
    }
}
