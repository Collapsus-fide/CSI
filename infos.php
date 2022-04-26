<?php
phpinfo();

/*<input type="datetime-local" id="date" name="date"
       value="2018-07-22"
       min="2022-26-04" max="2022-12-31">

       <input type="radio" id="paiement" name="paiement" value="No">
<label for="No">No</label><br>
<input type="radio" id="paiement" name="paiement" value="Yes">
<label for="Yes">Yes</label><br>

            <button class="btn btn-primary" type="submit" onclick="envoie()"><span class="glyphicon glyphicon-shopping-cart"></span>envoyer</button>
 */

/*
        function envoie(){
            var monPanier = new Panier();
            var
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
    req = new AjaxRequest(
        {

            url        : "envoieCommande.php",
            method     : 'Get',
            handleAs   : "Json",
            parameters : {
                id : {$u->getId()},
                panier : monPanier
                date : document.getElementById("date").value
                paiement : paiementParam

                wait:""
            },
            onSuccess  : function(res) {
                document.getElementById("chansons").innerHTML = res;
                req = null ;
            },
            onError : function(res) {
                req = null ;
            }
        });
*/