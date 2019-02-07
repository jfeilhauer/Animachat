<?php
class chat 
{
    private $pohled = '';
    //
    public function __construct(){
        $animatori = $this->nactiAnimatory();
        for ($i=0;$i<count($animatori);$i++){
            $id = $animatori[$i]['id'];
            $name = $animatori[$i]['name'];
            $vorname = $animatori[$i]['vorname'];
            $this->pohled .= '<div class="users" onclick="selectUser('.$id.');"><img src="../img/avatars/a'.$id.'.png"><div class="name">'.$name.' '.$vorname.'</div></div>';
        }  
    }
    private function nactiAnimatory(){
        return Db::dotazVsechny('
             SELECT `id`,`name`,`vorname`
             FROM `users`
             ', array());	
	}
    public function vypisAnimatory(){
        return $this->pohled;
    }    
} 
?>