<?php
require_once('autoload.include.php') ;

User::logoutIfRequested() ;

$p = new WebPage('connexion') ;

try {

    $u = User::createFromSession();

    $p->appendContent(<<<HTML
        {$u->profile()}
        <a href='index.php'></a>
        {$u->logoutForm($_SERVER['PHP_SELF'], 'Se déconnecter')}
HTML
    );
}
catch (NotInSessionException $e) {


    $p->appendToHead(<<<HTML
               
                <meta http-equiv="refresh" content="1; URL=index.php">
HTML
    );
}

$p->appendToHead(<<<HTML
<meta charset="UTF-8">
    <meta name="keywords" content="connexion" />
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

    <script src="bootstrap/js/bootstrap.js"></script>

HTML
);

$p->appendContent(<<<HTML
<!-- jQuery -->
    <script src="js/jquery-3.6.0.js"></script>
    
    
    <!-- MAIN JS -->
    <script src="js/main.js"></script>
</div>
HTML
            );


echo $p->toHTML() ;


/*                <div class="form-group clearfix">
                    <div class="checkbox-custom checkbox-inline checkbox-primary float-left rememberpass">
                        <input type="checkbox" id="rememberusername" name="rememberusername" value="1"  />
                        <label for="rememberusername">Se souvenir du nom d'utilisateur</label>
                    </div>
                </div>
*/