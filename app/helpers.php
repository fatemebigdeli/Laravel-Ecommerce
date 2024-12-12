<?php

use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;

if (!function_exists('generateFileName')) {
    function generateFileName($name)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $hour = Carbon::now()->hour;
        $minute = Carbon::now()->minute;
        $second = Carbon::now()->second;
        $microsecond = Carbon::now()->microsecond;

        return $year . '_' . $month . '_' . $day . '_' . $hour . '_' . $minute . '_' . $second . '_' . $microsecond . '_' . $name;
    }
}

if (!function_exists('convertShamsiToGregorianDate')) {
    function convertShamsiToGregorianDate($date)
    {
        if($date == null){
            return null;
        }
        $pattern = '/[-\s]/';
        $shamsiDateSplite = preg_split($pattern, $date);
        $arrayGerigorianDate = Verta::jalaliToGregorian($shamsiDateSplite[0], $shamsiDateSplite[1], $shamsiDateSplite[2]);

        return implode('-', $arrayGerigorianDate) . ' ' . $shamsiDateSplite[3];
    }
}
