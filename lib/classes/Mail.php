<?php 

require_once(__DIR__ . "/../../bootstrap.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {
    
    static protected $validationLink = "http://localhost/organizer-breakable/loginpage/checkMail.php";

    static public function instantiate() : object {

        $mail = null;

        if (null === $mail) {
            
            $mail = new PHPMailer(True);

            try {

                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = True;                                   // Enable SMTP authentication
                $mail->Username   = 'eugene.sinamban@gmail.com';                     // SMTP username
                $mail->Password   = 'ofbdfotodunvknxt';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;       
                $mail->setFrom('eugene.sinamban@gmail.com', 'Organizer Team');                             // TCP port to connect to

            } catch (Exception $e) {

                error_log($e->getMessage());
                throw new \Exception("Mailer error, please try again!");

            }
            
            return $mail;

        }

    }

    static public function send(array $details) : void {

        try {
        
        $mail = self::instantiate();

        //Recipients
        $mail->addAddress($details['email'], $details['lastName']);     // Add a recipient
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Welcome to Organizer";
        $mail->Body    = self::body($details);
        $mail->AltBody = self::body($details);

        $mail->send();
            
        } catch (Exception $e) {

            error_log($e->getMessage());
            throw new \Exception("Mailer error, please try again!");

        }


    }

    static public function body(array $details) : string {

        $body = null;

        if (null === $body) {

            $body = "   Hi! This is your verification email! 
            please visit this site!<a href='" . self::$validationLink . "?token=" . $details['token'] . "&email=" . $details['email'] . "'>Click Here!</a>";

        }

        return $body;

    }

}
?>