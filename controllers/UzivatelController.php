<?php
// Třída pro práci s uživatelskými daty
class UzivatelController extends Controller
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'Nastavení',
			'klicova_slova' => 'Animachat',
			'popis' => 'Nastavení, registrace',
            'css' => '../css/editace.css'
		);
        // vykreslení editace uživatele
        if((isset($_COOKIE['user'])) AND (!$_POST))
        {
            $this->user = Db::dotazUserData($_COOKIE['user'], "username, name, vorname, fce");
            $this->nastaveni='Nastavení';
            $this->view ='editUser';
        }
        // odeslání registrace
        elseif(isset($_POST['name']) AND (!isset($_COOKIE['user'])))
        {
            $this->nastaveni='Registrace';
            $newUser = Array($_POST['username'],$_POST['name'],$_POST['vorname'],$_POST['password'],$_POST['email'],"child");
            $registrace = new Registrace($newUser);
            if($registrace->getUspech())
                echo ('<div class="serverMess">Registrace úspěšně dokončena!<br><a href="/">Přejít na hlavní stranu</a></div>');
            else
                echo ('<div class="serverMess">Chyba!<br><a href="/uzivatel">Zkusit znovu</a></div>');
        }
        // odeslání editace
        elseif((isset($_POST['newName'])) OR (isset($_POST['newVorname'])) OR (isset($_POST['newPasswordAgain'])) OR (isset($_FILES['newAvatar'])))
        {
            $this->nastaveni='Nastavení';
            $id= $_COOKIE['user'];
            $newData= Array($_POST['newName'],$_POST['newVorname'],$_POST['newPasswordAgain'], $id);
            $edit = new editUzivatel($newData, $_FILES['newAvatar']);
            if($edit->getUspech()){
                echo ('<div class="serverMess">Údaje uloženy!<br><a href="/">Přejít na hlavní stranu</a></div>');
            }
            else{
                echo ('<div class="serverMess">Chyba při ukládání!<br><a href="/uzivatel">Zkusit znovu</a></div>');
            }
        }
        // vykreslení registrace
        else
        {
            $this->nastaveni='Registrace';
            $this->view ='registrace';
        }
    }
}
?>