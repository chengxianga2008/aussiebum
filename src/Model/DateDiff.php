<?php

declare(strict_types=1);

namespace App\Model;

use App\Library\Log;
use DateTime;
use DateTimeZone;

/**
 * [Description DateDiff]
 */
class DateDiff
{
    private ?DateTime $first_date;
    private ?DateTime $second_date;
    const SECONDS_IN_DAY = 60 * 60 * 24;

    /**
     * @param string $first_date
     * @param string $second_date
     */
    public function __construct(string $first_date, string $second_date)
    {
        $this->first_date = DateTime::createFromFormat('d/m/Y', $first_date, new DateTimeZone('UTC')) ?: null;

        if( DateTime::getLastErrors()['warning_count'] > 0 ){
            throw new \Exception("first date parsed error");
        }

        if (!$this->first_date) {
            throw new \Exception("first date format is not correct");
        }

        $this->second_date = DateTime::createFromFormat('d/m/Y', $second_date, new DateTimeZone('UTC')) ?: null;
        
        if( DateTime::getLastErrors()['warning_count'] > 0 ){
            throw new \Exception("second date parsed error");
        }
        
        if (!$this->second_date) {
            throw new \Exception("second date format is not correct");
        }
    }

    /**
     * @return bool
     */
    public function computeDiff(): int
    {
        $first_ts = $this->first_date->getTimestamp();
        $second_ts = $this->second_date->getTimestamp();
        $days_diff = abs($first_ts - $second_ts) / self::SECONDS_IN_DAY;
        $elapsed_days = $days_diff - 1; // exclude the start date and end date
        $elapsed_days = ($elapsed_days > 0) ? $elapsed_days : 0; // if elapsed day less than 0, make it 0
        return $elapsed_days;
    }
}
