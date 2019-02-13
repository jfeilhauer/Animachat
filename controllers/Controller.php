<?php
// Třída hlavního Controller

abstract class Controller
{
    // Vlastnosti controlleru
        // Pole s indexy viditelnými v šabloně jako běžné proměnné
        protected $data = array();
        // Proměnná názvu pohledu (šablony) bez přípony
        protected $view = "";
        // Hlavička stránky HTML
        protected $hlavicka = array('titulek' => '' , 'klicova_slova' => '' , 'popis' => '', 'css' =>'');
        // uživatel
        protected $user = array('username' => '', 'name' => '', 'vorname' => '' , 'fce' => '');
        // přepínání nápisu tlačítka nastavení v menu
        protected $nastaveni = '';
    // Metody controlleru
        // ošetření vstupů
        private function osetri($x=null)
        {
            if (!isset($x))
                return null;
            elseif (is_string($x))
                return htmlspecialchars($x, ENT_QUOTES);
            elseif (is_array($x))
            {
                foreach($x as $k => $v)
                {
                        $x[$k] = $this->osetri($v);
                }
                return $x;
            }
            else
                return $x;
        }

        // Vypíše pohled na stránku
        public function vypisView($user= Array())
        {
            // Pokud je zadán pohled
            if($this->view){
                // z indexů udělá proměnné podle klíčů a ošetří je
                extract($this->osetri($this->data));
                // neošetří proměnné s prefixem _
                extract($this->data, EXTR_PREFIX_ALL, "");
                // Zahrnutí souboru pohledu ze složky views
                extract($this->osetri($user));
                require("views/" . $this->view . ".phtml");
            }
        }
        // metoda pro přesměrování na danou url
        public function presmeruj($url)
        {
            header("Location: /$url");
            header("Connection: close");
        }
                
        // Hlavní metoda controlleru
        abstract function zpracuj($parametry);

}
?>