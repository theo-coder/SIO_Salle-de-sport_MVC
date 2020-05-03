<?php

############################################
#        API CREATED FOR PHP 7.4           #
#                                          #
# Created by TeissierYannis                #
# Github: http://github.com/teissierYannis/#
#                                          #
# Dependencies : MailSender                #
############################################

namespace TeissierYannis\Utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './Models/Dependencies/PHPMailer/src/Exception.php';
require './Models/Dependencies/PHPMailer/src/PHPMailer.php';
require './Models/Dependencies/PHPMailer/src/SMTP.php';

/**
 * This class is used to send email
 * Class MailSender
 * @package TeissierYannis\Utils
 */
class MailSender{

    /**
     * SMTP HOST
     * @var string
     */
    private static $host = "ssl0.ovh.net";
    
    /**
     * SMTP PORT
     * @var int
     */
    private static $port = 587;
    
    /**
     * SMTP USERNAME
     * @var string
     */
    private static $username = "sport@theoposty.fr";
    
    /**
     * SMTP PASSWORD
     * @var string
     */
    private static $password = "\$LoQfttV!%nMa5Hi";

    /**
     * Allow SMTP Authentication
     * @var int Default true
     */
    private static $SMTPAuthentication = true;

    /**
     * STMP CHARSET
     * @var string Default UTF-8
     */
    private static $charset = 'UTF-8';
    
    /**
     * This email is used for the displayed mail. (SENDER)
     * @var string
     */
    private static $senderEmail = "newsletter@entre-halteres.fr";
    
    /**
     * This name is used for the displayed name (SENDER)
     * @var string
     */
    private static $senderName = "Newsletter - Entre-Haltères";

    /**
     * Subject of the mail
     * @var string
     */
    private static $subject = "Newsletter";

    /**
     * Define the basic configuration
     * @return PHPMailer
     */
    private static function setMail(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = self::$charset;
        $mail->Host = self::$host;                      // SMTP server example
        $mail->SMTPDebug = 0;                           // enables SMTP debug information (for testing)
        $mail->SMTPAuth = self::$SMTPAuthentication;    // enable SMTP authentication
        $mail->Port = self::$port;                      // set the SMTP port for the server
        $mail->Username = self::$username;              // SMTP account username example
        $mail->Password = self::$password;              // SMTP account password example
        return $mail;
    }

    /**
     * Send email
     * @param $to Send to user(s)
     * @param $content Body of the mail
     * @return string
     * @throws Exception
     */
    public static function sendEmail($to, $content){
        $to = json_decode($to, true);
        $i = 0;
        foreach ($to as $u):
            if (!filter_var($u['mail'], FILTER_VALIDATE_EMAIL)) $emailErr = "Invalid email format";

            $mail = MailSender::setMail();

            if(isset($emailErr)):
                    return "Error :" . $emailErr . "with the mail : ". $u['mail'];
            else:
                $mail->setFrom(self::$senderEmail, self::$senderName);
                $mail->addAddress($u['mail'], '');
                $mail->isHTML(true);
                $mail->Subject = self::$subject;
                $mail->Body = $content;
                $mail->AltBody = strip_tags($content);
                $mail->send();
            endif;
            $i++;
            
        endforeach;
    }
}
