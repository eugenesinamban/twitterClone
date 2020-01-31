<?php 
require_once(__DIR__ . "/AppModel.php");
//
class Workplace extends AppModel {
    //
    // class for shifts
    // Program uses this class to add, edit, and delete data from DB
    //
    static protected $table = "`userWorkplace`";
    //
    static protected $keys = [

        "`inputId`",
        "`userId`"
    
    ];
    // 
    static public function getWorkplaces() {
        //
        $sql = "    SELECT *
                    FROM ". self::$table . "
                    WHERE `userId` = :userId
        ";
        //
        $objects = [
            'userId' => $_SESSION['auth']['id']
        ];
        //
        try {
            // 
            $workplaces = self::fetchData($sql, $objects);
        } catch (Throwable $e) {
            // 
            throw new Exception($e->getMessage());
            exit;
        }
        // 
        if (!$workplaces) {
            // 
            // if data does not exist, return false
            // 
            return false;
        }
        // 
        return $workplaces;
    }
    
}
?>

