<?php
require_once(__DIR__ . "/AppModel.php");
//
class Utilities extends AppModel{
    
    static public function totalTime(array $objects) : string {
        //
        // prepare objects
        //
        $dateStart = $objects['shiftDateStart'];
        $timeStart = $objects['shiftStart'];
        $dateEnd = $objects['shiftDateEnd'];
        $timeEnd = $objects['shiftEnd'];
        //
        $totalStart = date("Y-M-d H:i", strtotime("$dateStart $timeStart"));
        $totalEnd = date("Y-M-d H:i", strtotime("$dateEnd $timeEnd"));
        $totaltime = (strtotime($totalEnd) - strtotime($totalStart)) / 60 / 60;
        //
        return $totaltime;
        //
    }

    static public function getMonthlyTotals($month ,$year) {
        
        // get monthly salary and work hours

        $return = [

            'salary' => 0,
            'totalHours' => 0

        ];

        $sql = "    SELECT `workplaceId`, `shiftDateStart`, `shiftStart`, `shiftDateEnd`, `shiftEnd`, `calendar`.`userId`, `userworkplace`.`wage`, `userworkplace`.`transportation`
                    FROM `calendar`
                    LEFT JOIN `userworkplace`
                    ON calendar.workplaceId = userworkplace.inputId
                    WHERE YEAR(`calendar`.`shiftDateStart`) = :Year
                    AND MONTH(`calendar`.`shiftDateStart`) = :Month
                    AND `calendar`.`userId` = :userId
                    ORDER BY `calendar`.`shiftDateStart`
        ";
        
        $objects = [
            //
            'Month' => $month,
            'Year' => $year,
            'userId' => $_SESSION['auth']['id']
        ];
        
        $shifts = self::fetchData($sql, $objects);
        
        if (!$shifts) {
            // 
            // return false if no values
            // 
            return null;
        }

        foreach ($shifts as $shift) {

            $totalTime = self::totalTime($shift);

            $return['salary'] += ($totalTime * $shift['wage']) + $shift['transportation'];

            $return['totalHours'] += $totalTime;
            
        }

        return $return;
        
    }
    
    static public function getPosts() : ?array {
        //
        $select = "
            `posts`.`id`,
            `posts`.`createdAt`,
            `name`,
            `post`,
            `email`
        ";
        
        $sql = "    SELECT $select
                    FROM `posts` 
                    LEFT JOIN `users` 
                    ON posts.userId = users.Id
                    ORDER BY `posts`.`createdAt` DESC
        ";
        
        $objects = [
            // 
        ];
        //
        $shifts = self::fetchData($sql, $objects);
        // 
        return $shifts ?: Null;
    }
}
?>
