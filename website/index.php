<?php
declare(strict_types=1);
require_once 'class/WebPage.class.php';

if (isset($_GET["index"])) {
    $index= $_GET["index"];
}
$page = new WebPage('CSI');
$page->appendToHead(<<<HTML
<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>index</title>
HTML
);
$page->appendCssUrl("css/navBar.css");
$page->appendCssUrl("bootstrap/css/bootstrap.min.css");
$page->appendCssUrl("fontAwesome/css/font-awesome.min.css");

$page->appendCssUrl("css/carrousel.css");

$page->appendJsUrl("bootstrap/js/bootstrap.min.js");
$page->appendJsUrl("js/jquery-3.3.1.slim.min.js");

$page->appendJsUrl("js/carrousel.js");
$page->appendJs(<<<JS
$(function () {
    $(window).on('scroll', function () {
        if ( $(window).scrollTop() > 10 ) {
            $('.navbar').addClass('active');
        } else {
            $('.navbar').removeClass('active');
        }
    });
});
JS
);
$page->appendContent(<<<HTML
<!-- Navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container"><a href="#" class="navbar-brand text-uppercase font-weight-bold">Vente de trucs</a>
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>
            
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="#" class="nav-link text-uppercase font-weight-bold">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Magasin</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Inscription</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>


HTML
);
$images = [];
if (isset($index)){
    //$images= image::getFromIdProd($index);
}else{
    //$images = image::getFromIdProd(1);
}

$encodedImage = '';
$page->appendCssUrl('css/carrousel.css');
$page->appendContent(<<<HTML
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    
  </ol>
  <div class="carousel-inner">
HTML
);
        $page->appendContent(<<<HTML
            <div class="carousel-item active">
HTML
        );
    $page->appendContent(<<<HTML
            <img class="d-block w-100 " src="images/tomates.PNG" alt="Erreur d'affichage">
            <div class="carousel-caption d-none d-md-block">
                <h5>test</h5>
                <p>test2</p>
            </div>
        </div>
HTML
    );
$page->appendContent(<<<HTML
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="container">
    <div class="pt-5 text-white">
        <div class="py-5">
            <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="py-5">
            <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
    </div>
</div>
HTML
);



echo $page->toHTML();

