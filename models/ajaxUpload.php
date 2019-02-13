<?php 
// soubor pro komunikaci javascriptu se serverem
class ajaxUpload 
{
    public function __construct($user,$user_to,$zprava)
    {
        Db::pripoj(dbAddress,dbUsername,dbPassword,database);
        Db::dotazVsechny("INSERT INTO `messages` (`ID`, `user_id`, `mess_to`, `message`, `time`) VALUES (NULL, ?, ? ,? , CURRENT_TIMESTAMP);", array($user,$user_to,$zprava));
    }
}
?>