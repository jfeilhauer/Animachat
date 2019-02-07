<?php
class Logout {
    public function __construct(){
        setcookie("user", "", time() - 3600);    
    }
};
?>