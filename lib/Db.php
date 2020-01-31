<?php 
require_once(__DIR__ . "/Config.php");
class DB {
    //
    static public function databaseConnect() {
        //
        $pdo = null;
        if (null === $pdo) {
            try {
                //
                // get DB configuration from db config class
                $config = Config::dbConfig();
                $host = $config['host'];
                $db = $config['db'];
                $user = $config['user'];
                $pass = $config['pass'];
                $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
                $options = [
                    //
                    PDO::ATTR_ERRMODE                   => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE        => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES          => false,
                    PDO::MYSQL_ATTR_MULTI_STATEMENTS    => false
                    //
                ];
                //
                $pdo = new PDO($dsn, $user, $pass, $options);
            } catch (Throwable $e) {
                error_log($e->getMessage());
                throw new Exception("Database connection failed!");
                exit;
            }
        }
        //
        return $pdo;
    //
    }
//
}

?>