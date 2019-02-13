<?php
// Kontroler pro download ajaxového požadavku
class AjaxDController extends Controller
{
    public function zpracuj($parametry)
    {
        $pocet = $_POST['pocet']*10;
        $user1 = $_POST['user1'];
        $user2 = $_POST['user2'];
        $aDownload = new ajaxDownload($user1,$user2,$pocet);
        echo $aDownload->vytvorZpravy();
    }
}