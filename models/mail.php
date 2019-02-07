<?php
require './models/PHPMailer.php';
require './models/SMTP.php';

class mail {
    private $data = Array(
        'to' => '',
        'nameto' => "",
        'from' => "animachat@seznam.cz",
        'namefrom' => "Jaromír Feilhauer",
        'subject' => "Resetování hesla",
        'message' => "Nové heslo: "
    );
    private $uspech = false; 
    // metody
    private function generujHeslo(){
        $heslo = '';
        $pismena = 'abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
        $cisla = '0123456789';
        $specZnaky = '@#&$*-+';
        for ($i = 0; $i < 2; $i++) {
            $n1 = mt_rand(0, strlen($pismena)-1);
            $n2 = mt_rand(0, strlen($cisla)-1);
            $n3 = mt_rand(0, strlen($specZnaky)-1);
            $heslo .= $pismena[$n1].$cisla[$n2].$specZnaky[$n3];
        }
        return $heslo;
    }
    private function ulozHeslo($heslo, $email){
        return Db::dotazJeden('
             UPDATE `users`
             SET `password` = ? 
             WHERE `email`=?
             ', array($heslo, $email));    
    }
    private function overEmail($email){
         return Db::dotazJeden('
             SELECT `email`
             FROM `users` 
             WHERE `email`=?
             ', array($email));    
    }
    public function __construct($email){
        $this->data['to'] = $email;
        if($this->overEmail($this->data['to'])){
            $heslo = $this->generujHeslo();
            $this->data['message'] .= $heslo;
   // engine pro posílání emailů přes SMTP
   $mail = new PHPMailer(TRUE);
   /* Set the mail sender. */
   $mail->setFrom($this->data['from'], $this->data['namefrom']);

   /* Add a recipient. */
   $mail->addAddress($this->data['to'], $this->data['nameto']);

   /* Set the subject. */
   $mail->Subject = $this->data['subject'];

   /* Set the mail message body. */
   $mail->Body = $this->data['message'];

   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   
   /**/
   $mail->CharSet = 'UTF-8';
   
   /* SMTP server address. */
   $mail->Host = 'smtp.gmail.com';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   $mail->SMTPSecure = 'tls';
   
   /* SMTP authentication username. */
   $mail->Username = 'jjjaaarrrooommmiiirrr@gmail.com';
   
   /* SMTP authentication password. */
   $mail->Password = 'rbou sqkc myzb sbbq';
   
   /* Set the SMTP port. */
   $mail->Port = 587;
   
   /* Finally send the mail. */
   $mail->send();
   // Konec enginu
            $this->uspech = true;
            $this->ulozHeslo($heslo, $this->data['to']);
        }
        else {
            $this->uspech = false;
        }
    }
    public function getUspech(){
        return $this->uspech;
    }
}

