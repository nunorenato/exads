<?php

namespace App;

use App\Exceptions\InvalidDateException;

/**
 * Class that represents a day and time in a generic week
 */
class ScheduleTime
{
    /**
     * @var int|null 1 - Monday, 7 - Sunday
     */
    public int $dayOfWeek;
    /**
     * @var int|null Time in seconds for the showing, where 0 equals 00:00 hours
     */
    public int $timeInSeconds;
    /**
     * @var int The timestamp for which this object might have been created from.
     */
    public int $referenceTimestamp;

    /**
     * @param int|null $dayOfWeek
     * @param int|null $timeInSeconds
     */
    public function __construct(int $dayOfWeek, int $timeInSeconds, int $referenceTimestamp = 0)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->timeInSeconds = $timeInSeconds;
        $this->referenceTimestamp = $referenceTimestamp;
    }


    /**
     * Creates from a date string, exs: 2023-06-11; 2022-06-12 11:00
     *
     * @param string $dateTime
     * @return static
     */
    public static function fromString(string $dateTime):self{
        $timestamp = strtotime($dateTime);
        if($timestamp === false)
            throw new InvalidDateException('Invalid date');

        return self::fromTimestamp($timestamp);
    }

    /**
     * Creates from an unix timestamp
     *
     * @param int $timestamp
     * @return static
     */
    public static function fromTimestamp(int $timestamp):self{
        return new self(date('N', $timestamp), (int)date('H', $timestamp)*3600 + (int)date('i',$timestamp)*60, $timestamp);
    }

    public function setReferenceTimestamp(int $timestamp):self{
        $this->referenceTimestamp = $timestamp;
        return $this;
    }

    /**
     * uses the reference timestamp to return a real world date
     *
     * @return string
     */
    public function toRealDate():string{
        $currWeekDay = date('N', $this->referenceTimestamp);
        $offset = $currWeekDay-$this->dayOfWeek;
        $offset += $currWeekDay<0?7:0;

        return date('Y-m-d', $this->referenceTimestamp+$offset) . ' ' . date('H:i', $this->timeInSeconds);
    }
}
