<?php

namespace App\Custom;

use Illuminate\Database\QueryException;
use Illuminate\Http\Response;

// use Symfony\Component\Debug\Exception\FatalThrowableError;

class ModelHelper
{
    public static function convertClarionDate($date)
    {
        if (is_numeric($date)) {
            return $date;
        }

        /* Converts a date sent in an UNAMBIGUOUS format (e.g. dd MMM yyyy or yyyy-mm-dd to a Clarion date */

        $thisDate = strtotime($date); // Get the unix date for the sent date (in seconds since 1 Jan 1970)

        $baseDate = mktime(0, 0, 0, 1, 1, 1980); //Set a base date that UNIX can Handle (it cant go before 1/1/1902!!)

        $daysDiff = $thisDate - $baseDate; //Get the difference (in seconds)

        $clarionDays = (int) floor($daysDiff / 86400); //Divide by (60*60*24) and round down to the whole number to give us the no of days since 1/1/1980

        $clarionDays += 65382; //Add the days since 1/1/1800 Clarions Base Date to give us the Clarion Date integer for $SentDate

        return $clarionDays;
    }

    public static function convertClarionTime($time)
    {
        // return $time;
        if (is_numeric($time)) {
            return $time;
        }  //returns if in numeric format already

        $seconds = strtotime("1970-01-01 $time UTC"); // converts HH:MM:SS into numeric ( seconds )

        $milliseconds = $seconds * 100;

        return $milliseconds;
    }

    public function keysToLower($arr)
    {

        // Here is the most compact way to lower case keys in a multidimensional array
        //https://www.php.net/manual/en/function.array-change-key-case.php

        return array_map(function ($item) {
            if (is_array($item)) {
                $item = $this->keysToLower($item);
            }

            return $item;
        }, array_change_key_case($arr));
    }
}
