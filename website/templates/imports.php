<?php

declare(strict_types=1);
include "autoload.include.php";
$connected = false;
if (User::isConnected()) {
    $connected = true;
    //header("Location: http://{$_SERVER['SERVER_NAME']}/".dirname($_SERVER['PHP_SELF'])."/form.php?logout") ;
    //die() ;
}

try {
    $user = User::createFromSession();
} catch (NotInSessionException $e) {
} catch (Exception $e) {

}

$page = new WebPage('CSI');
$page->appendToHead(<<<HTML
<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>index</title>
HTML
);

$page->appendCssUrl("bootstrap/css/bootstrap.css");
$page->appendCssUrl("fontAwesome/css/fontawesome.css");
$page->appendCssUrl('css/font-awesome.min.css');

$page->appendJsUrl("js/jquery-3.6.0.js");
$page->appendJsUrl("fontAwesome/js/fontAwesome.js");
$page->appendJsUrl("bootstrap/js/bootstrap.js");
$page->appendJsUrl("bootstrap/js/bootstrap.js");

include "templates/navBar.php";
