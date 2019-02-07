<?php
// Počáteční soubor webu
// Autor: Jaromír Feilhauer



// Nastavení interního kódování
mb_internal_encoding("utf-8");

// Automatické načítání tříd controllerů a method
function autoloadFunkcion($class)
{
	// Končí název třídy řetězcem "Controller" 
    if (preg_match('/Controller$/', $class))	
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}
// Registrace autoloadu
spl_autoload_register("autoloadFunkcion");

// Připojení k databazi pomocí DB ovladače

Db::pripoj(dbAddress,dbUsername,dbPassword,database);

// Zpracování údajů z URL od uživatele a vytvoření směrovače
$smerovac = new SmerovacController();
$smerovac->zpracuj(array($_SERVER["REQUEST_URI"]));
$smerovac->vypisView();