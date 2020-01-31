<?php

require_once "AppModel.php";

class Posts extends AppModel {

    static protected $table = "`posts`";

    static public function getAll() : array {

        $sql = "    SELECT *
                    FROM " . self::$table;

        $objects = [];

        return self::fetchData($sql, $objects);

    }

}

?>