<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Model\DateDiff;
use DateTime;

/**
 * [Description BankTransactionTest]
 */
class DateDiffTest extends TestCase
{

    /**
     * @return void
     */
    public function testComputeDiff(): void
    {
        $days = new DateDiff('02/06/1983', '22/06/1983');
        $this->assertEquals(19, $days->computeDiff());

        $days = new DateDiff('04/07/1984', '25/12/1984');
        $this->assertEquals(173, $days->computeDiff());

        $days = new DateDiff('03/01/1989', '03/08/1983');
        $this->assertEquals(1979, $days->computeDiff());
    }
}
