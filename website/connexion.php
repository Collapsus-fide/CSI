<?php

require_once('autoload.include.php');

User::logoutIfRequested();

$p = new WebPage('hello');

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

            $form = User::loginFormSHA512('auth.php');
    }
include "templates/imports.php";

    $p->appendCSS(<<<CSS
    form input {
        width : 4em ;
    }
CSS
    );


    $p->appendContent(<<<HTML
        <div class="d-flex flex-row wrap">
            {$form}
        </div>
HTML
    );


echo $p->toHTML();


/*                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left rememberpass">
                        <input type="checkbox" id="rememberusername" name="rememberusername" value="1"  />
                        <label for="rememberusername">Se souvenir du nom d'utilisateur</label>
                    </div>
                </div>
*/
