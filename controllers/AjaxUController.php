<?php
// konroler pro upload dat z ajaxového požadavku
class AjaxUController extends Controller
{
    public function zpracuj($parametry)
    {
	   $user = $_POST['user'];
       $user_to = $_POST['user_to'];
       $zprava = $_POST['zprava'];
       $aUpload = new ajaxUpload($user,$user_to,$zprava);  
    }
}