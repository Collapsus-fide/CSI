<?php

require_once('autoload.include.php');

User::logoutIfRequested();

$page = new WebPage('connexion');

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

            $form = User::loginForm('auth.php');
    }
include "templates/imports.php";

    $page->appendCSS(<<<CSS
    form input {
        width : 4em ;
    }
CSS
    );


    $page->appendContent(<<<HTML
                {$form}
HTML
    );


echo $page->toHTML();


/*                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left rememberpass">
                        <input type="checkbox" id="rememberusername" name="rememberusername" value="1"  />
                        <label for="rememberusername">Se souvenir du nom d'utilisateur</label>
                    </div>
                </div>
*/
