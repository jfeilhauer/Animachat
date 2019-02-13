<?php
class ZapomenuteHesloController extends Controller
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'Zapomenuté heslo',
			'klicova_slova' => 'zapomenute, heslo',
			'popis' => 'Změna zapomenutého hesla',
            'css' => '../css/ZapomenuteHeslo.css'
		);
        $this->nastaveni='Registrace';
        $this->view ='zapomenuteHeslo';
		if(isset($_POST['email'])){
            $mail = new mail($_POST['email']);
            if($mail->getUspech()){
                echo ('<div class="serverMess">Na email bylo odesláno nové heslo<br><a href="/">přejděte na přihlašování</a></div>');
            }
            else{
                echo ('<div class="serverMess">Zadali jste špatný email<br><a href="/ZapomenuteHeslo">Zkusit znovu</a></div>');
            }
        }
    }
}
?>