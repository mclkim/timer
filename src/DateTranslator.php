<?php
/**
 * Created by PhpStorm.
 * User: 김준수
 * Date: 2018-12-26
 * Time: 오후 3:37
 */

namespace Mcl\Timer;


class DateTranslator
{
    public static function translateDate($date, $lang = null)
    {
        $divider = '';

        if (empty($date)) {
            return null;
        }
        if (strpos($date, '-') !== false) {
            $divider = '-';
        } else if (strpos($date, '/') !== false) {
            $divider = '/';
        }
        //spanish format DD/MM/YYYY hh:mm
        if (strcmp($lang, 'es') == 0) {

            $type = explode($divider, $date)[0];
            if (strlen($type) == 4) {
                $date = self::reverseDate($date, $divider);
            }
            if (strcmp($divider, '-') == 0) {
                $date = str_replace("-", "/", $date);
            }
            //english format YYYY-MM-DD hh:mm
        } else {

            $type = explode($divider, $date)[0];
            if (strlen($type) == 2) {
                $date = self::reverseDate($date, $divider);
            }
            if (strcmp($divider, '/') == 0) {
                $date = str_replace("/", "-", $date);
            }
        }
        return $date;
    }

    public static function reverseDate($date)
    {
        $date2 = explode(' ', $date);
        if (count($date2) == 2) {
            $date = implode("-", array_reverse(preg_split("/\D/", $date2[0]))) . ' ' . $date2[1];
        } else {
            $date = implode("-", array_reverse(preg_split("/\D/", $date)));
        }

        return $date;
    }

    public static function translate($date, $format = 'Ymd')
    {
        $old_date = dateTranslator::translateDate($date);
        $middle = strtotime($old_date);             // returns bool(false)
        if ($middle)
            return date($format, $middle);
        else
            return null;
    }
}