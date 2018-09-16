<?php declare(strict_types=1);

namespace Kuria\DevMeta;

use Kuria\PhpUnitExtras\Traits\AssertionTrait;
use Kuria\PhpUnitExtras\Traits\ClockTrait;
use PHPUnit\Framework\TestCase;

abstract class Test extends TestCase
{
    use AssertionTrait;
    use ClockTrait;
}
