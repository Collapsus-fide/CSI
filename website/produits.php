<?php
require_once ("autoload.include.php");
try{
    $u = User::createFromSession();
}catch (NotInSessionException $e){
    header("Location: http://{$_SERVER['SERVER_NAME']}/".dirname($_SERVER['PHP_SELF'])."/connexion.php") ;
    die() ;
}

include "templates/imports.php";
$produits = Produit::getAll();
$page->appendJsUrl("js/ajaxrequest.js");
$page->appendJs(<<<JS
    $('#envoie').click(function(){
     new AjaxRequest(
        {
            url        : "envoieCommande.php",
            method     : 'Get',
            handleAs   : "Json",
            parameters : {
                id : {$u->getId()},
                panier : monPanier
                date : dateParam
                paiement : paiementParam
                
                wait:""
            },
            onSuccess  : function(res) {
                                window.alert('Error ' + status + ': ' + message) ;

            },
            onError : function(res) {
                window.alert('Error ' + status + ': ' + message) ;
            }
        });
}
JS
);
$page->appendToHead(<<<HTML
<script type="text/javascript">

        function ajouter(code,prix1)
        {
            //var code = parseInt(document.getElementById("id").value);
            var qte = parseInt(document.getElementById("qte_"+code).value);
            var prix = parseFloat(prix1);
            var monPanier = new Panier();
            monPanier.ajouterArticle(code, qte, prix);
            var tableau = document.getElementById("tableau");
            var longueurTab = parseInt(document.getElementById("nbreLignes").innerHTML);
            if (longueurTab > 0)
            {
                for(var i = longueurTab ; i > 0  ; i--)
                {
                    monPanier.ajouterArticle(parseInt(tableau.rows[i].cells[0].innerHTML), parseInt(tableau.rows[i].cells[1].innerHTML), parseInt(tableau.rows[i].cells[2].innerHTML));
                    tableau.deleteRow(i);
                }
            }
            var longueur = monPanier.liste.length;
            for(var i = 0 ; i < longueur ; i++)
            {
                var ligne = monPanier.liste[i];
                var ligneTableau = tableau.insertRow(-1);
                var colonne1 = ligneTableau.insertCell(0);
                colonne1.innerHTML += ligne.getCode();
                var colonne2 = ligneTableau.insertCell(1);
                colonne2.innerHTML += ligne.qteArticle;
                var colonne3 = ligneTableau.insertCell(2);
                colonne3.innerHTML += ligne.prixArticle;
                var colonne4 = ligneTableau.insertCell(3);
                colonne4.innerHTML += ligne.getPrixLigne();
                var colonne5 = ligneTableau.insertCell(4);
                colonne5.innerHTML += "<button class=\"btn btn-primary\" type=\"submit\" onclick=\"supprimer(this.parentNode.parentNode.cells[0].innerHTML)\"><span class=\"glyphicon glyphicon-remove\"></span> Retirer</button>";
            }
            document.getElementById("prixTotal").innerHTML = monPanier.getPrixPanier();
            document.getElementById("nbreLignes").innerHTML = longueur;
        }

        function supprimer(code)
        {
            var monPanier = new Panier();
            var tableau = document.getElementById("tableau");
            var longueurTab = parseInt(document.getElementById("nbreLignes").innerHTML);
            if (longueurTab > 0)
            {
                for(var i = longueurTab ; i > 0  ; i--)
                {
                    monPanier.ajouterArticle(parseInt(tableau.rows[i].cells[0].innerHTML), parseInt(tableau.rows[i].cells[1].innerHTML), parseInt(tableau.rows[i].cells[2].innerHTML));
                    tableau.deleteRow(i);
                }
            }
            monPanier.supprimerArticle(code);
            var longueur = monPanier.liste.length;
            for(var i = 0 ; i < longueur ; i++)
            {
                var ligne = monPanier.liste[i];
                var ligneTableau = tableau.insertRow(-1);
                var colonne1 = ligneTableau.insertCell(0);
                colonne1.innerHTML += ligne.getCode();
                var colonne2 = ligneTableau.insertCell(1);
                colonne2.innerHTML += ligne.qteArticle;
                var colonne3 = ligneTableau.insertCell(2);
                colonne3.innerHTML += ligne.prixArticle;
                var colonne4 = ligneTableau.insertCell(3);
                colonne4.innerHTML += ligne.getPrixLigne();
                var colonne5 = ligneTableau.insertCell(4);
                colonne5.innerHTML += "<button class=\"btn btn-primary\" type=\"submit\" onclick=\"supprimer(this.parentNode.parentNode.cells[0].innerHTML)\"><span class=\"glyphicon glyphicon-remove\"></span> Retirer</button>";
            }
            document.getElementById("prixTotal").innerHTML = monPanier.getPrixPanier();
            document.getElementById("nbreLignes").innerHTML = longueur;
        }
        
    </script>
HTML
);
$page->appendJsUrl("js/panier.js");
$page->appendContent(<<<HTML
<div style="height: 10em"></div>
<div class="row " style="padding-top: = 5%";>
HTML
);
foreach ($produits as $produit){
    $page->appendContent(<<<HTML
<div class="col-sm-3 " ">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{$produit->getNom()}</h5>
            <p>{$produit->prix} et {$produit->getId()}</p>
            <label for="q">Quantité: </label>
            <article class="well form-inline pull-left col-lg-5">
        <label class="col-lg-3" >Quantité</label> : <input type = "number" id = "qte_{$produit->getId()}" style="width:120px" class="input-sm form-control"></input><br><br>
        <button class="btn btn-primary" type="submit" onclick="ajouter({$produit->getId()},{$produit->getPrix()})"><span class="glyphicon glyphicon-shopping-cart"></span> Ajouter au panier</button>
    </article>
        </div>
    </div>
</div>

HTML
    );

}
$page->appendContent(<<<HTML
<section class="container">
    <article class="well form-inline pull-left col-lg-5">
        <legend>Contenu du panier</legend>
        <table id="tableau" class="table">
            <thead>
            <tr>
                <th>Code</th>
                <th>Qte</th>
                <th>Prix unitaire</th>
                <th>Prix de la ligne</th>
                <th>Supprimer</th>
            </tr>
            </thead>
        </table>
        <br><label>Prix du panier total</label> : <label id = "prixTotal"></label>
        <label id = "nbreLignes" hidden>0</label>
    </article>
</section>
</div>
<input type="datetime-local" id="date" name="date"
       value="2018-07-22"
       min="2022-26-04" max="2022-12-31">

       <input type="radio" id="paiement" name="paiement" value="No">
<label for="No">No</label><br>
<input type="radio" id="paiement" name="paiement" value="Yes">
<label for="Yes">Yes</label><br>
<button id="envoie">Click me</button>
            
HTML
);

echo $page->toHTML();