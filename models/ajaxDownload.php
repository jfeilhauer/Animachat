<?php 
// soubor pro komunikaci javascriptu se serverem
class ajaxDownload 
{
    private $export = '';
    //
    public function __construct($user1,$user2,$pocet){
        $pole = $this->ctiZpravy($user1, $user2,$pocet);
        
        $tag = "";
        for ($i=0;$i<count($pole);$i++){
            for($j=1;$j<=4;$j++){
                 $tag=$pole[$i][$j];
                 $this->export .= "|".$tag;
            }            
        }
    }
    private function ctiZpravy($user1, $user2, $pocet)
    {
        $dotaz = "SELECT * FROM (SELECT `ID`, `user_id`, `mess_to`, `message`, `time` FROM `messages` WHERE ((`user_id`=? AND `mess_to`=?) OR (`user_id`=? AND `mess_to`=?)) ORDER BY `ID` DESC LIMIT ".$pocet." ) AS `messages` ORDER BY `ID` ASC";
        Db::pripoj(dbAddress,dbUsername,dbPassword,database);
        return Db::dotazVsechny($dotaz, array($user1, $user2, $user2,$user1));
    }
    
    public function vytvorZpravy(){
        return $this->export;
    }
    
}
?>