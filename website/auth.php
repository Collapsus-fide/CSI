<?php
require_once('autoload.include.php') ;

$p = new WebPage('Authentification') ;

try {
            $user = User::createFromAuthSHA512($_REQUEST);
            $user->saveIntoSession();
            $p->appendToHead("<meta http-equiv='refresh' content='3; URL=index.php'>");
            $p->appendToHead(<<<HTML
                <meta http-equiv="refresh" content="1; URL=index.php">
HTML
            );

   // {$user->login()}
    $p->appendContent(<<<HTML
    <div>Bienvenue
    </div>
    <h3> Vous allez être redirigé vers votre page d'accueil.</h3>

HTML
    ) ;
}
catch (AuthenticationException $e) {

    $p->appendContent("Couple Login/Mot de passe incorrecte") ;
}
catch (Exception $e) {
    $p->appendContent("Erreur : {$e->getMessage()}") ;
}


echo $p->toHTML() ;
