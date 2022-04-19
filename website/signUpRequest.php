<?php
require_once('autoload.include.php') ;

$p = new WebPage('inscription') ;
try {
    User::signUpRequest($_REQUEST);
    $p->appendToHead(<<<HTML
                <meta http-equiv="refresh" content="1; URL=index.php">
HTML
    );
    $p->appendContent(<<<HTML
    <div>Bienvenue
    </div>
    <h3> Vous allez être redirigé vers votre page d'accueil.</h3>

HTML
    ) ;
}
catch (Exception $e) {
    $p->appendContent("Erreur : {$e->getMessage()}") ;
}


echo $p->toHTML() ;