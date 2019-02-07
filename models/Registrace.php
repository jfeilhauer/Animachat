<?php 
class Registrace {
    private $uspech = false;
    //
    public function __construct($user){
        if($this->overUser($user[0])){  
            $this->ulozUser($user);
            $this->avatar();
        }
        else{
            $this->uspech = false;
        }
    }
    private function ulozUser($user){
        Db::dotazJeden('
            INSERT INTO `users` (`username`,`name`, `vorname`, `password`, `email` , `fce`)
            VALUES (?, ?, ?, ?, ?, ?)'
            ,$user);
    }
    private function getUsernames(){
        return Db::dotazVsechny('SELECT `username` FROM `users`' , Array());
    }
    private function avatar(){
        $id = Db::dotazJeden('SELECT MAX(`ID`) AS `id` FROM `users`');
        if($_FILES['avatar']!=''){
            $filename = "a".$id['id'].".png"; 
            $tmpfilename = $_FILES["avatar"]["tmp_name"]; 
            $cesta = "./img/avatars/".$filename;
            if (is_uploaded_file($tmpfilename)){
                if (move_uploaded_file($tmpfilename, $cesta)){
                    $this->uspech = true;
                }
                else {
                    $this->uspech = false;
                }
            }
            else {
                $this->uspech = false;
            }        
        }
        else {
            copy("./img/avatar.png", "./img/avatars/a".$id['id'].".png");      
        }
    }
    private function overUser($username){
        $usernames = $this->getUsernames(); 
        for($i= 0;$i < count($usernames); $i++){
             if($username == $usernames[$i]['username']){
                $uspesne = false;
                break;
             }
             else{
                $uspesne = true;
             }
        }
        return $uspesne;
    }
    public function getUspech(){
        return $this->uspech;
    }
}                
?>
    