<?php
require_once('autoload.include.php');
$page = new WebPage("Commandes");
include "templates/imports.php";

try{
    $u = User::createFromSession();
}catch (NotInSessionException $e){
    header("Location: http://{$_SERVER['SERVER_NAME']}/".dirname($_SERVER['PHP_SELF'])."/connexion.php") ;
    die() ;
}

$commandes = Commande::getByIdCli($u->id_client);

$page->appendContent(<<<HTML
<div style="height: 10em"></div>
<div class="row " style="padding-top: = 5%";>
HTML
);
foreach ($commandes as $commande) {
    $page->appendContent(<<<HTML
<div class="col-sm-3 " ">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{$commande->getId()}</h5>
            <p>{$commande->prix_a_payer}</p>
    </article>
        </div>
    </div>
</div>

HTML
    );
}


echo $page->toHTML();
