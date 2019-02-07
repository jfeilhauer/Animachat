<?php
// Index Controller (hlavní stránka)

class IndexController extends Controller
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'Hlavní strana',
			'klicova_slova' => 'animachat, chat',
			'popis' => 'Stránka pro chatování si s přáteli',
            'css' => '../css/index.css'
		);
        
        if(isset($_POST['name']) AND isset($_POST['password'])){
            $user = new Login($_POST['name'], $_POST['password']);
            $this->user = $user->getUser();
            if(($this->user != 'false') AND (isset($_COOKIE['username']))){            
                $this->view = 'index_log';
                $this->nastaveni = 'Nastavení';
            }
            else {
                $this->user='';
                $this->presmeruj('index');
            }
        }
        elseif(isset($_COOKIE['user'])){		
		    $this->nastaveni = 'Nastavení';
            $this->user = Db::dotazUserData($_COOKIE['user'], "username, name, vorname, fce");
            $this->view = 'index_log';
        }
        else  {
            $this->view = 'index';
            $this->nastaveni = 'Registrace';            	
        }    	
        
    }
}    
?>