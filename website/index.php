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
		<meta name="author" content="Codrops" />
HTML
);
$page->appendContent(<<<HTML
<p>page index</p>
HTML
);



echo $page->toHTML();

