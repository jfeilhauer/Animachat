<?php

// Směrovač který nám podle zadané URL zavolá
// příslušný controller stránky a pohled vloží do šablony

class SmerovacController extends Controller
{
    // Vlastnost controlleru
    protected $controller;

    // Metoda, která převede pomlčkovou variantu controlleru na název controlleru bez přípony
    public function pomlckyDoVelNot($text)
    {
        // Nahradí pomlčku za mezeru
        $veta = str_replace('-', ' ', $text);
        // Změní počáteční písmena na Velká
		$veta = ucwords($veta);
        // Odstraní mezery
		$veta = str_replace(' ', '', $veta);
		return $veta;
    }
    // Naparsuje URL adresu, rozdělí podle lomítek do pole 
	private function parsujURL($url)
	{
		// Naparsuje jednotlivé části URL adresy do asociativního pole
        $naparsovanaURL = parse_url($url);
		// Vybereme část s cestou a odstraníme počáteční lomítko
		$naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
		// Odstraníme bílé znaky okolo adresy
		$naparsovanaURL["path"] = trim($naparsovanaURL["path"]);
		// Rozbijeme řetězcec podle lomítek
		$rozdelenaCesta = explode("/", $naparsovanaURL["path"]);
		return $rozdelenaCesta;
	}
    // Vytvoření příslušného controlleru a naparsování url
    public function zpracuj($parametry)
    {
		// Parsování url
        $naparsovanaURL = $this->parsujURL($parametry[0]);
		// Pokud je cesta prázdná(počáteční stránka), vykreslí se index		
		if (empty($naparsovanaURL[0]))		
            $naparsovanaURL[0]= 'index';		
		// Controller je 1. parametr URL
		$tridaKontroleru = $this->pomlckyDoVelNot(array_shift($naparsovanaURL)) . 'Controller';
		// Pokud existuje daný kontroler vytvoř objekt, jinak přesměruj na stránku chyba
		if (file_exists('controllers/' . $tridaKontroleru . '.php'))
			$this->controller = new $tridaKontroleru;
        else
            $this->presmeruj('chyba');
		
		// Volání controlleru
        $this->controller->zpracuj($naparsovanaURL);
		
		// Nastavení proměnných pro danou šablonu
		$this->data['titulek'] = $this->controller->hlavicka['titulek'];
		$this->data['popis'] = $this->controller->hlavicka['popis'];
		$this->data['klicova_slova'] = $this->controller->hlavicka['klicova_slova'];
		$this->data['css'] = $this->controller->hlavicka['css'];
        $this->data['user'] = $this->controller->user;        
        $this->data['nastaveni']= $this->controller->nastaveni;
        
		// Nastavení hlavní šablony
		$this->view = 'rozlozeni';
    }
      
}

?>