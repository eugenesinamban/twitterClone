<?php 
require_once(__DIR__ . "/../Db.php");

class AppModel {
    
    // class for shifts
    // Program uses this class to add, edit, and delete data from DB
    
    static protected $table;
    
    static protected $keys;

    static public function prepare(array $array) : array {
        
        // check if input is empty
        
        if ([] === $array) {
            
            throw new Exception("Input is invalid!");
        }
        
        $objects = [];
        
        // prepare trimmed and valid values

        foreach ($array as $key => $value) {
            
            if ("" === trim($value) && false !== $value) {

                throw new Exception("Input is Invalid!");

            }
            
            $objects[$key] = trim($value);
            
        }
        
        // return valid, escaped objects
        
        return $objects;
        
    }
    
    static public function bindValue(object $pdo , array $objects) : void {

        foreach ($objects as $key => $value) {

            if (is_numeric($value) || is_bool($value) || is_float($value)) {

                $pdo->bindValue(":{$key}", $value, PDO::PARAM_INT);

            }

            if (is_string($value)) {

                $pdo->bindValue(":{$key}", $value, PDO::PARAM_STR);

            }

        }
        
        return;

    }

    static public function fetchDatum(string $sql, array $objects) {
        
        // used to fetch data via fetch
        
        $pdo = DB::databaseConnect();
        $fetch = $pdo->prepare($sql);
        $fetch->execute($objects);
        $show = $fetch->fetch();
        
        if (!$show) {
            
            return False;
            
        }
        
        return $show;    
    }
    
    static public function fetchData(string $sql, array $objects) {
        
        // used to fetch data via fetch
        
        $pdo = DB::databaseConnect();
        $fetch = $pdo->prepare($sql);
        $fetch->execute($objects);
        $show = $fetch->fetchAll();
        
        if (!$show) {
            
            return False;
            
        }
        
        return $show;    
    }
    
    //////////////////////////////////
                                                 
                //   Input part                     //
                                                 
    //////////////////////////////////
    
    public function insert(array $objects)  {
        
        $objects = static::Prepare($objects);
        
        $keys = array_keys($objects);
        $values = [];
        $columns = [];
        
        // parse
        
        foreach ($keys as $key) {
            
            $values[] = ":{$key}";
            $columns[] = "`{$key}`";
        }
        
        $sql = "    INSERT
                    INTO " . static::$table . " (" . implode(',', $columns) . ")
                    VALUES (" . implode(',', $values) .")
        ";
        
        try {
            
            $pdo = DB::databaseConnect();
            $pdo->beginTransaction();
            $placeholder = $pdo->prepare($sql);
            static::bindValue($placeholder, $objects);
            $placeholder->execute();
            
        } catch (Exception $e) {
            
            // rollback on failure, then send message
            
            $pdo->rollBack();
            error_log($e->getMessage());
            // throw new Exception("Unexpected error! Please try again!");
            throw $e;
            
        }
        
        $pdo->commit();
        return;
        
    }
    
    static public function update(array $objects, array $keys) : void {
        
        // use array keys to make placeholder
        
        $placeholder = [];
        $where = [];

        $objects = static::prepare($objects);
        $keys = static::prepare($keys);
        
        foreach ($objects as $key => $value) {
            
            $placeholder[] = "`{$key}` = :{$key}";

        }

        // create where query and merge input objects and keys

        foreach ($keys as $key => $value) {
            $objects[$key] = $value;
            $where[] = "`{$key}` = :{$key}";
        }
        
        // prepare sql
        
        try {
            
            if ([] === $placeholder || [] === $where) {
                
                // if any of the placeholder is empty, return false
                
                throw new Exception("Please enter correct value!");
                
            }
            
            $sql = "    UPDATE " . static::$table . "
                        SET " . implode(',', $placeholder) . "
                        WHERE " . implode(' AND ', $where) 
            ;
            
            // update line, then get affected row count
            
            $pdo = DB::databaseConnect();
            
            $send = $pdo->prepare($sql);
            $send->execute($objects);
            $receive = $send->rowCount();
            
            // if affected row count is 0, return false
            
            if (0 === $receive) {
                
                throw new Exception("Update failed, please try again!");
            }
            
            return;
            
        } catch (Exception $e) {
            
            throw new Exception($e->getMessage());
        }
    }    
    
    static public function delete(array $objects)  {
        
        // prepare placeholder
        // add user id for WHERE query
        
        $objects = static::prepare($objects);
        $placeholder = [];
        
        // Parse
        
        foreach ($objects as $key => $value) {
            
            $placeholder[] = "`{$key}` = :{$key}";
        }
        
        // prepare SQL
        
        $sql = "    DELETE
                    FROM " . static::$table . "
                    WHERE " . implode(' AND ', $placeholder)
        ;
        try {
            
            // delete line, then get affected row count
            
            $pdo = DB::databaseConnect();
            
            $send = $pdo->prepare($sql);
            $send->execute($objects);
            $receive = $send->rowCount();
            
            // if affected row count is 0, return false
            
            if (0 === $receive) {
                
                throw new Exception("Delete failed, please try again!");
            }
            
        } catch (Exception $e) {
            
            throw new Exception($e->getMessage());
        }
        
        return;
    }
    
    static public function findBy(array $parameters) {

        //  prepare keys and placeholder

        $objects = static::Prepare($parameters);
        $objectKeys = array_keys($objects);
        $queryPlaceholder = [];
        foreach ($objectKeys as $key) {
            
            $queryPlaceholder[] = "`{$key}` = :{$key}";
        } 
        $sql = "    SELECT *
                    FROM " . static::$table . "
                    WHERE " . implode(' AND ', $queryPlaceholder) . "
        ";
                    
        $user = static::fetchDatum($sql, $objects);
        
        if (!$user) {
            return null;
        } 

        return $user;
    }
}


?>

