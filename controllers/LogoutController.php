<?php
class LogoutController extends Controller
{
	public function zpracuj($parametry)
	{
		$this->hlavicka = array(
			'titulek' => 'Odhlaseni',
			'klicova_slova' => 'odhlaseni',
			'popis' => 'odhlaseni'
		);
		$odhlaseni = new Logout();
        $this->presmeruj('index');
    }
}
?>