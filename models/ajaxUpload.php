<?php 
// soubor pro komunikaci javascriptu se serverem
require_once '../models/Db.php';
class ajaxUpload 
{
    public function __construct($user,$user_to,$zprava)
    {
        Db::pripoj(dbAddress,dbUsername,dbPassword,database);
        Db::dotazVsechny("INSERT INTO `messages` (`ID`, `user_id`, `mess_to`, `message`, `time`) VALUES (NULL, ?, ? ,? , CURRENT_TIMESTAMP);", array($user,$user_to,$zprava));
    }
}
$user = $_POST['user'];
$user_to = $_POST['user_to'];
$zprava = $_POST['zprava'];
$aUpload = new ajaxUpload($user,$user_to,$zprava);
?>