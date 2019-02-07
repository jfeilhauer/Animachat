<?php
// pro editaci uživatelksých dat
class editUzivatel{
    private $uspech = false;
    private $data = Array();
    public function __construct($newData, $avatar){
        $this->Filtr($newData);
        $this->ulozData($this->data);
        if($avatar!=''){
            $this->updateAvatar($avatar);
        }
        else {
            $this->uspech = true;
        }
    }
    private function vratUser($user)
	{ 
	   return Db::dotazJeden('
             SELECT `name`,`vorname`, `password`,`ID`
             FROM `users`
             WHERE `id`=?
             ', array($user));	
	}
    private function Filtr($newData){
         $dataUser= $this->vratUser($newData[3]);
         for($i=0;$i<4;$i++){
            if($newData[$i]!=''){
                $this->data[$i] = $newData[$i];   
            }
            else {
                $this->data[$i] = $dataUser[$i];
            }
         }
    }
    private function UlozData($data){
        Db::dotazJeden('
        UPDATE `users`
        SET `name`=?,`vorname`=?, `password`=?
        WHERE `ID`=?'
        ,$data);
    }
    public function getUspech(){
        return $this->uspech;
    }
    private function updateAvatar($avatar){
        $filename = "a".$this->data[3].".png"; 
        $tmpfilename = $avatar["tmp_name"]; 
        $cesta = "./img/avatars/".$filename;
        if (is_uploaded_file($tmpfilename)){
            unlink($cesta);
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
}
?>