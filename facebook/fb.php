<?php
// Údaje z https://www.facebook.com/developers/
define('APP_ID', '343846319780613');
define('APP_SECRET', 'a5da07bb14f83f9e0b54e8772f5ba9c7');
define('CANVAS_PAGE', 'http://apps.facebook.com/anima-board');
define('CANVAS_URL', 'http://localhost/facebook/fb.php');

// Facebook knihovna z Github.com
require_once 'lib/facebook.php';

// Vytvoříme instanci Facebook knihovny
$facebook = new Facebook( array('appId' => APP_ID, 'secret' => APP_SECRET, ));

// Získáme ID přihlášeného uživatele
$user = $facebook->getUser();

// Je uživatel přihlášený na Facebooku? resp. máme session?
if(isset($user)) {
    try {
        // Zkusíme získat jeho profilová data (na uživatelova data nepotřebujeme extended_permission)
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        // Vypíšeme text Exception
        echo "<strong>" . $e->getMessage() . "</strong>";
        $user = NULL;
    }
}

// Uživatel se odhlásil, odstranil aplikaci...
if(!is_null($user)) {
    // Získáme logout url
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    // Získáme přihlašovací url
    $loginUrl = $facebook->getLoginUrl();
}
?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Zdroják.cz - Hello world aplikace</title>
</head>

<body>
  <p>
    Ahoj
    <strong><?php if(!is_null($user)) echo $user_profile["name"]; ?></strong>, jak je? :-)
  </p>

  <h2>Přihlásit / odhlásit?</h2>
  <p>
    <?php if ($user): ?>
    <a href="<?php echo $logoutUrl;?>">Odhlásit se z Facebooku!</a>
    <?php else:?>
    <a href="<?php echo $loginUrl;?>">Přihlásit se na Facebook!</a>
    <?php endif?>
  </p>
</body>
</html>