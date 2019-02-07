<?php
define('UPLOAD_DIR', '../soubory/');
	$img = $_POST['avatar'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
    $a=0;
    while(file_exists("../soubory/a".$a.".png")){
        $a++;
    }
	$file = UPLOAD_DIR . "a" .$a. '.png';
	$success = file_put_contents($file, $data);
	echo $success ? $file : 'Unable to save the file.';
?>