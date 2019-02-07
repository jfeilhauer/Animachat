<?php
class Db
{
	// Proměnné databáze
	private static $spojeni;
    private static $nastaveni = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
        PDO::ATTR_EMULATE_PREPARES => false,
        );

	// funkce
	public static function pripoj($host, $uzivatel, $heslo, $databaze)
    {
        if (!isset(self::$spojeni))
        {
                self::$spojeni = @new PDO(
                        "mysql:host=$host;dbname=$databaze",
                        $uzivatel,
                        $heslo,
                        self::$nastaveni
                );
        }
    } 
    
    // Methoda pro zavolání jednoho řádku
	public static function dotazJeden($dotaz, $parametry = array())
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetch();
    }	
    // dotaz na více řádků
    public static function dotazVsechny($dotaz, $parametry = array())
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->fetchAll();
    }
    // dataz vrací první výsledek
    public static function dotazSamotny($dotaz, $parametry = array())
    {
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek[0];
    }
    
    // Spustí dotaz a vrátí počet ovlivněných řádků
    public static function dotaz($dotaz, $parametry = array())
    {
        $navrat = self::$spojeni->prepare($dotaz);
        $navrat->execute($parametry);
        return $navrat->rowCount();
    }
    public static function dotazUserData($user, $sloupec)
    {
        htmlspecialchars($sloupec);
        $dotaz ="SELECT ".$sloupec." FROM `users` WHERE `id`=?";
        $parametry = array($user);
        $vysledek = self::dotazJeden($dotaz, $parametry);
        return $vysledek;
    }
}
define('dbAddress', 'localhost');
define('dbUsername','root');
define('dbPassword', '');
define('database', 'animabilovec');   
?>