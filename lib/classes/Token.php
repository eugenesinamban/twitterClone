<?php 

class Token {
    // 
    static public function generate($len = 32) : string {
        return bin2hex(random_bytes($len));
    }
}

?>