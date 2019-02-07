<?php
// konroler, který se načte při nenalezení žádné stránky nebo souboru
class ChybaController extends Controller
{
    public function zpracuj($parametry)
    {
		// Hlavička požadavku
		header("HTTP/1.0 404 Not Found");
		// Hlavička stránky
		$this->hlavicka['titulek'] = 'Chyba 404';
		// Nastavení šablony
		$this->view = 'chyba';
        $this->hlavicka['css'] = '';
        $this->nastaveni= 'Registrace';
    }
}