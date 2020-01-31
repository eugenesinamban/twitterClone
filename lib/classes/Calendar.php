<?php 

class Calendar {
    //
    /////////////////////////////////////
    //-----------Properties------------//
    /////////////////////////////////////
    //
    static protected $year = null;
    static protected $month = null;
    static protected $date = null;
    static protected $days = [
        //
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
    ];
    static protected $shortDays = [
        // 
        "M",
        "T",
        "W",
        "T",
        "F",
        "S",
        "S"
    ];
    //
    /////////////////////////////////////
    //--------------Methods------------//
    /////////////////////////////////////
    static public function setDate(string $date) : void {

        self::$date = date("d", mktime(0,0,0,1,$date));

    }

    static public function getDate() : string {

        if (null === self::$date) {

            self::$date = date("d", time());
        }
        
        return self::$date;
    }
    
    static public function setMonth(string $month) : void {
        //
        self::$month = date("m", mktime(0,0,0,$month,1));
    }
    //
    static public function getMonth() : string {
        //
        if (null === self::$month) {
            //
            self::$month = date("m", time());
        }
        return self::$month;
    }
    //
    static public function setYear(string $year) : void {
        //
        self::$year = date("Y", mktime(0,0,0,1,1,$year));
    }
    //
    static public function getYear() : string {
        //
        if (null === self::$year) {
            //
            self::$year = date("Y", time());
        }
        return self::$year;
    }
    //
    static public function endDate() : string {
        //
        if (null === self::$month) {
            self::setMonth(date('m', time()));
        }
        //
        if (null == self::$year) {
            self::setYear(date("Y", time()));
        }
        return date("t", strtotime(self::getYear() . '-' . self::getMonth() . '-01'));
    }
    //
    static public function startDay() : string {
        //
        if (null == self::$month) {
            self::setMonth(date('m', time()));
        }
        //
        if (null == self::$year) {
            self::setYear(date("Y", time()));
        }
        return date("N", strtotime(self::getYear() . '-' . self::getMonth() . '-01'));
    }

    static public function lastDay() : string {

        if (null == self::$month) {
            self::setMonth(date('m', time()));
        }
        //
        if (null == self::$year) {
            self::setYear(date("Y", time()));
        }
        return date("N", strtotime(self::getYear() . '-' . self::getMonth() . "-" . self::endDate()));
    }
    //
    static public function showDays() : array{
        //
        return self::$days;
    }
    // 
    static public function showShortDays() : array {
        //
        return self::$shortDays;
    }
    //
    static public function numberOfWeeks() : string {
        //
        $year = self::getYear();
        $month = date('m',strtotime('2020-' . self::getMonth() . '-01'));
        $numberOfWeeks = 0;
        $endDate = self::endDate();
        $numberOfWeeks = ($endDate % 7 === 0 ? 0 : 1) + intval($endDate / 7);
        $monthFirstDay = date("N", strtotime($year . '-' . $month . '-01'));
        $monthLastDay = date("N", strtotime($year . '-' . $month . '-' . $endDate));
        if ($monthLastDay < $monthFirstDay) {
            //
            $numberOfWeeks++;
        }
        return $numberOfWeeks;
    }
    //
    static public function startDayBuffer( string $startDay) : string {
        //
        $buffer = 0;
        $buffer = 7 - $startDay;
        return $buffer;
    }
    //
}
?>
