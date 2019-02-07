<?php
class Login
{  
    private $udaje;
	// Hlavní methoda
    public function __construct($username ,$password){
        $udaje = $this->vratUser($username);
        if (($username === $udaje['username']) AND ($password === $udaje['password'])){
            setcookie("user", $udaje['id'] , time() + (60*60), "/");
            setcookie("chybneUdaje", "false", time() + (60*60), "/");
            $this->udaje = $udaje;
        }
        else{
            setcookie("chybneUdaje", "true", time() + (30*60), "/");
            $this->udaje = 'false';
        }
    } 
	private function vratUser($user){ 
	   return Db::dotazJeden('
             SELECT `id`,`username`,`name`, `password`, `fce`
             FROM `users`
             WHERE `username`=?
             ', array($user));	
	}
    public function getUser(){
        return $this->udaje;
    } 
} 
?>