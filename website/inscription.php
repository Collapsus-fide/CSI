<?php
require_once("autoload.include.php");


require_once('autoload.include.php');

User::logoutIfRequested();

$p = new WebPage('inscription');

try {
    $u = User::createFromSession();
    header('Location: form.php?logout');
    /*$u = User::createFromSession() ;

    $p->appendContent(<<<HTML
        {$u->profile()}
        <a href='page1.php'>page 1</a>
        {$u->logoutForm($_SERVER['PHP_SELF'], 'Se déconnecter')}
HTML
) ;*/

} catch (NotInSessionException $e) {

    $form = User::SignUpForm('signUpRequest.php');
}

$p->appendContent(<<<HTML
            {$form}
HTML
);

echo $p->toHTML();