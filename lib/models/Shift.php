<?php 
require_once(__DIR__ . "/AppModel.php");
//
class Shift extends AppModel {
    //
    // class for shifts
    // Program uses this class to add, edit, and delete data from DB
    //
    static protected $table = "`calendar`";
    //    
    static protected $keys = [

        "`inputId`",
        "`userId`"

    ];

    static public function fetchShifts(string $date, string $month, string $year) : array {

        $select = "
            `calendar`.`inputId`,
            `shiftDateStart`,
            `shiftStart`,
            `shiftDateEnd`,
            `shiftEnd`,
            `calendar`.`userId`,
            `workplaceId`,
            `userworkplace`.`workplace`,
            `userworkplace`.`wage`,
            `userworkplace`.`transportation`
        ";
        
        $sql = "    SELECT $select
                    FROM `calendar` 
                    LEFT JOIN `userworkplace` 
                    ON calendar.workplaceId = userworkplace.inputId 
                    WHERE DAY(`calendar`.`shiftDateStart`) = :date
                    AND MONTH(`calendar`.`shiftDateStart`) = :month
                    AND YEAR(`calendar`.`shiftDateStart`) = :year
                    AND `calendar`.`userId` = :userId
                    ORDER BY `calendar`.`shiftStart`
        ";

        $objects = [

            'date' => $date,
            'month' => $month,
            'year' => $year,
            'userId' => $_SESSION['auth']['id']

        ];
        $shifts = false !== self::fetchData($sql, $objects) ? self::fetchData($sql, $objects) : [];

        return $shifts;
        
    }
}

?>

