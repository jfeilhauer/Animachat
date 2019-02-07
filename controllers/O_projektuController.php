<?php
// Controller pro stránku- O projektu (počáteční stránka)

class O_projektuController extends Controller
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'O projektu',
			'klicova_slova' => 'animachat, chat, o projektu',
			'popis' => 'Stránka pro chatování si s přáteli',
            'css' => '../css/o_projektu.css'
		);
        if(isset($_COOKIE['username'])){
            $this->nastaveni='Nastavení';
            $this->user = Db::dotazUserData($_COOKIE['user'], "username, name, vorname, fce");
        }
        else {
            $this->nastaveni='Registrace';
        }
        $this->view = 'o_projektu';    	
        
    }
}    
?>