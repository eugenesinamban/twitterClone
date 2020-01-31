<?php 

require_once(__DIR__ . "/AppModel.php");
require_once(__DIR__ . "/../classes/Token.php");
require_once(__DIR__ . "/../classes/Mail.php");
////////////////
//            //
// USER CLASS //
//            //
////////////////
class Users extends AppModel {
    //
    //Users class is used for adding users, searching users, deleting users.
    //
    static protected $table = "`users`";
    // 
    static protected $keys = ["`id`"];
    // 
    static public function login(array $loginValues) : void {
    
        // prepare input values

        $objects = self::prepare($loginValues);
            
        //  fetch user details of user
            
        $user = self::findBy(['email' => $objects['email']]);
            
        if (!$user) {
            //  
            //  if user does not exist, throw exception
            //  
            throw new Exception("Incorrect E-mail and password combination!");
        }
        //  
        //  get password from objects then check if it matches
        //  
        $pass = $loginValues['password'];
        //  
        if (false === password_verify($pass, $user['password'])) {
            //  
            //  if verification fails, throw exception
            //  
            throw new Exception("Incorrect E-mail and password combination!");
            //  
        }
         
        // check if validated
        
        // if (1 !== $user['verified']) {
        //     // 
        //     throw new Exception("Account not verified! Please check your email for verification!");
        // }

        //  if all successful, proceed with log in
        // save user id in session
        // regenerate session id to prevent hack

        $_SESSION['auth']['id'] = $user['id'];
        session_regenerate_id(true);
        return;
            
    }
    // 
    static public function signUp(array $array) : void {
        // 
        try {
            // 
            $objects = self::prepare($array);
            // 
            $user = self::findBy(['email' => $objects['email']]);
            // 
            if ($user) {
                // 
                throw new Exception("E-Mail address not available!");
            }
            // checks for duplicate user
            // 
            // if all is good, hash password then insert
            // 
            $objects['password'] = password_hash($objects['password'], PASSWORD_DEFAULT);
            // 
            // set verified to false
            // save token to DB
            // 
            // $objects['verified'] = false;
            // // 
            // $objects['token'] = Token::generate();
            // 
            Users::insert($objects);
            // 
            // if successful, send mail
            // 
            // Mail::send($objects);
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    // 
    
}
// 
?>


