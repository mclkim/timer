<?php

namespace Mcl\Timer;


final class Timer
{
    /**
     * Original code is written by Crizin (crizin@gmail.com)
     */
    private $start, $stop;

    function __construct()
    {
        $this->start();
    }

    public function start()
    {
        $this->start = $this->getMicroTime();
    }

    public static function getMicroTime()
    {
        list ($usec, $sec) = explode(' ', microtime());
        return ( float )$usec + ( float )$sec;
    }

    public static function resourceUsage(): string
    {
        return \sprintf(
            'Memory: %4.2fMB',
            \memory_get_peak_usage(true) / 1048576
        );
    }

    public function pause()
    {
        $this->stop = $this->getMicroTime();
    }

    public function resume()
    {
        $this->start += $this->getMicroTime() - $this->stop;
        $this->stop = 0;
    }

    public function fetch($decimalPlaces = 3)
    {
        return sprintf('%.3f', round(($this->getMicrotime() - $this->start), $decimalPlaces));
    }
}