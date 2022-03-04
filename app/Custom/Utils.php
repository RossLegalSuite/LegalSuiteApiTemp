<?php

namespace App\Custom;

use App\Custom\ModelHelper;
use Carbon\Carbon;
//https://carbon.nesbot.com/docs
//https://www.digitalocean.com/community/tutorials/easier-datetime-in-laravel-and-php-with-carbon
use Illuminate\Support\Facades\DB;

class Utils
{
	/* Test with 1 April 2018
use App\Custom\Utils;
use App\Custom\ModelHelper;
$date = 79352; // "2018-04-01"
Utils::getMonthEndFromClarionDate($date);
Utils::stringFromClarionDate($date);
Utils::unixFromClarionDate($date);
Utils::dateTimeFromClarionDate($date);
Utils::getDateFromClarionDate($date);
Utils::getMonthFromClarionDate($date);

$date = 80758; // "2022-02-05 (Saturday)"
Utils::getNextWorkingDay($date)
	*/

    public static function getNextWorkingDay($clarionDate) {

        $returnValue = (int) $clarionDate;

        while (Utils::isHoliday($returnValue) ) {
            $returnValue = $returnValue + 1;
        }

        return $returnValue;

    }

    public static function isHoliday($clarionDate) {

        $returnValue = false;

        if ( !isset($clarionDate) ) return $returnValue;

        $date = \Carbon\Carbon::parse( Utils::stringFromClarionDate($clarionDate) );

        if ($date->isWeekend()) {

            $returnValue = true;
            
        } else {

            $holiday = \App\GenericTableModels\holiday::where('Date',$clarionDate)->exists(); 

            if ($holiday ) $returnValue = true;

        }

        return $returnValue;

    }

    public static function generateLicenceNumber($companyName, $code, $users) {

        // For Testing
        // $companyName = 'Acme Attorneys';
        // $code = 'ABSA';
        // $users = 40;


        $name = strtoupper($companyName);

        $result = '';

        $control = DB::connection('sqlsrv')->table('control')->select('LicenceValidUntil')->first();
        
        if ( !isset($control->LicenceValidUntil) ) return $result; 

        $dateString = (string) $control->LicenceValidUntil;
        // First Number
        $number = (string) (ord($code[0]) + 17 + (int) $dateString[4]); 
        $result .= isset($number[1]) ? $number[1] : ' ';

        // Second Number
        $number = (string) (ord($name[0]) - ( (int) $users * 2 ) + (int) $dateString[3] + ord($code[2]) );
        $result .= isset($number[1]) ? $number[1] : ' ';

        // Third Number
        $number = (string) (ord($code[1]) + (int) $users + (int) $dateString[4] + ord($name[0]) );
        $result .= isset($number[1]) ? $number[1] : ' ';

        // Fourth Number
        $number = (string) (ord($name[1]) - ( (int) $users * 3 ) + (int) $dateString[2] + ord($code[2]) );
        $result .= isset($number[1]) ? $number[1] : ' ';

        // Fifth Number
        $number = (string) (ord($code[2]) + (int) $users + 11 + (int) $dateString[1] );
        $result .= isset($number[1]) ? $number[1] : ' ';

        // Sixth Number
        $number = (string) (ord($name[2]) + ( (int) $users * 2 ) - 14 + (int) $dateString[2] + ord($code[2]) );
        $result .= isset($number[1]) ? $number[1] : ' ';

        return $result;

    }


    public static function getMimeType($filename) {

        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);
    
        $mimet = array( 
            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',
    
            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
    
            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',
    
            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',
    
            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',
    
            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',
    
    
            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );
    
        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'application/octet-stream';
        }

    }

    public static function getFileType($filename) {

        $idx = explode( '.', $filename );
        $count_explode = count($idx);
        $idx = strtolower($idx[$count_explode-1]);
    
        $mimet = array( 
            'txt' => 'text',
            'htm' => 'html',
            'html' => 'html',
            'php' => 'html',
            'css' => 'css',
            'js' => 'javascript',
            'json' => 'json',
            'xml' => 'xml',
            'swf' => 'flash',
            'flv' => 'video',
    
            // images
            'png' => 'image',
            'jpe' => 'image',
            'jpeg' => 'image',
            'jpg' => 'image',
            'gif' => 'image',
            'bmp' => 'image',
            'ico' => 'image',
            'tiff' => 'image',
            'tif' => 'image',
            'svg' => 'image',
            'svgz' => 'image',
    
            // archives
            'zip' => 'zip',
            'rar' => 'zip',
            'exe' => 'zip',
            'msi' => 'zip',
            'cab' => 'zip',
    
            // audio/video
            'mp3' => 'audio',
            'mp4' => 'video',
            'qt' => 'video',
            'mov' => 'video',
    
            // adobe
            'pdf' => 'document',
            'psd' => 'photoshop',
            'ai' => 'postscript',
            'eps' => 'postscript',
            'ps' => 'postscript',
    
            // email
            'msg' => 'email',

            // ms office
            'doc' => 'document',
            'docx' => 'document',
            'rtf' => 'document',
            'xls' => 'document',
            'ppt' => 'document',
            'xlsx' => 'document',
            'pptx' => 'document',

            // open office
            'odt' => 'document',
            'ods' => 'document',
        );
    
        if (isset( $mimet[$idx] )) {
            return $mimet[$idx];
        } else {
            return 'other';
        }

        

    }

    public static function evaluate($evaluate, $matter = null, $party = null) {

        // Testing
        //$evaluate = '$matter->ClaimAmount - 1200'; 
        //$matter = new \stdClass();
        //$matter->ClaimAmount = 5000;

        $returnValue = eval('return ' . $evaluate . ';'); 

        if ( $returnValue === false && ( $error = error_get_last() ) ) {

            throw new \Exception('<p>An error was encountered evaluating</p><p>' . $evaluate . '</p><p>' . $error['message'] . '</p>');

            exit; //You have to exit explicitly in case of an error
        }

        return $returnValue;

    }

    public static function isDecimal( $val ) {

        //https://stackoverflow.com/questions/6772603/check-if-number-is-decimal
        return is_numeric( $val ) && floor( $val ) != $val;

    }

    public static function stringFromClarionDate($date, $format = "d M Y") {

        $unixDate = ($date - 61730) * 86400;

        return date($format, $unixDate);
        
    }

    public static function unixFromClarionDate($date) {

        return ($date - 61730) * 86400;

    }

    public static function dateTimeFromClarionDate($date, $format = "d M Y") {

		$unixDate = ($date - 61730) * 86400;
		$dateString = date($format, $unixDate);
		return new \DateTime($dateString);

	}

    public static function getDateFromClarionDate($date) {

        return getDate( ($date - 61730) * 86400 );

    }
    
    public static function getMonthFromClarionDate($date) {

        $date = getDate( ($date - 61730) * 86400 );

        return $date['mon'];

    }

    public static function getEndOfYearDateFromClarionDate($clarionDate, $format = "d M Y") {

        $unixDate = ($clarionDate - 61730) * 86400;

        $dateString = date("d M Y", $unixDate);

        $date = Carbon::createFromDate($dateString)->endOfYear()->format($format);

        return ModelHelper::convertClarionDate( $date );

    }

    public static function getBeginningOfNextYearFromClarionDate($clarionDate, $format = "d M Y") {

        $unixDate = ($clarionDate - 61730) * 86400;

        $dateString = date("d M Y", $unixDate);

        $date = Carbon::createFromDate($dateString)->endOfYear()->addDays(1)->format($format);

        return ModelHelper::convertClarionDate( $date );

    }

    public static function getYearFromClarionDate($date) {

        $date = getDate( ($date - 61730) * 86400 );

        return $date['year'];

    }

    public static function getMonthEndFromClarionDate($date) {

        //https://stackoverflow.com/questions/1686724/how-to-find-the-last-day-of-the-month-from-date

		$unixDate = ($date - 61730) * 86400;

        $thisDate = date("Y-m-d", $unixDate);

        $monthEndDate = date("Y-m-t", strtotime($thisDate));

        return ModelHelper::convertClarionDate( $monthEndDate );
    }
    
    public static function getCurrentVatRate($date, $vatExemptFlag = 0, $vatMethod = 'Y', $vatPercent1 = 15, $vatPercent2 = 14) {

        try {

            $returnValue = 0;

            if ( $vatExemptFlag ) {

                $returnValue = 0;

            } else if ( $vatMethod != 'N' ) {

                if ($date < 79352) {

                    $returnValue = $vatPercent2; // Before 1 April 2018

                } else {

                    $returnValue = $vatPercent1;

                }
            }

            return $returnValue;

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    public function getVatPercent($vatRate) {

        /*
        $utils = new App\Custom\Utils; $utils->getVatPercent('1');
        */

        $control = DB::connection('sqlsrv')
        ->table('Control')
        ->select('VatPercent1', 'VatPercent2', 'VatPercent3')
        ->first();


        if ( $vatRate == '1' ) {
            return $control->VatPercent1;
        } else if ( $vatRate == '2' ) {
            return $control->VatPercent2;
        } else if ( $vatRate == '3' ) {
            return $control->VatPercent3;
        } else  {
            return '0';
        }

    }

    public function getVatIncl($amount, $percent) {

        /********************************************************
         * 11 Jan 2022
         * These vat mathods are a Work in Progress
         * Find them very confusing
         * Develop them further if needed
        ********************************************************/

        /*
        $utils = new App\Custom\Utils; $utils->getVatInc('100','15.00);
        */

        /*If LOC:VatIE = 'I'
        Return LOC:Amount
      Else
        Return ROUND(LOC:Amount * ROUND( (100 + SAV:Percent) / 100 , .0001) , .01)
      .*/


    }

    public function getVatAmount($amount, $vatPercent, $vatRate, $vatIe) {

        /*
        use App\Custom\Utils;Utils->getVatAmount('100', null, '1', 'E');
        $utils = new App\Custom\Utils; $utils->getVatAmount('100', null, '1', 'E');
        */
        

        if ( isset( $vatRate ) && !isset($vatPercent) ) {
            $savePercent = $this->getVatPercent($vatRate);
        } else {
            $savePercent = $vatPercent;
        }


        if ( $vatIe == 'E') {
            $returnValue = $this->getVatIncl($amount, $savePercent);
        } else {
            $returnValue = $amount;
        }

        return $returnValue;



        /*
        GetVatAmount         PROCEDURE  (LOC:Amount,LOC:VatPercent,LOC:VatRate,LOC:VatIE) ! Declare Procedure
        ezField              LONG
        LOC:ReturnValue      DECIMAL(13,2)
        SAV:Percent          DECIMAL(5,2)

        CODE
        If LOC:VatRate <> '' and LOC:VatPercent = 0
            SAV:Percent = GetVatPercent(LOC:VatRate)
        Else
            SAV:Percent = LOC:VatPercent
        .
        If LOC:VatIE = 'E'
            LOC:ReturnValue = GetVatIncl(LOC:Amount,SAV:Percent)
        Else
            LOC:ReturnValue = LOC:Amount
        .
        ! LOC:ReturnValue = ROUND(LOC:ReturnValue * ROUND(SAV:Percent / (100 + SAV:Percent),.0001) , .01)
        LOC:ReturnValue = ROUND(LOC:ReturnValue * (SAV:Percent / (100 + SAV:Percent)),.01)

        Return LOC:ReturnValue
          */
    }


}

