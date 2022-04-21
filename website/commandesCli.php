<?php
require_once('autoload.include.php');
$page = new WebPage("Commandes");
include "templates/imports.php";

echo $page->toHTML();
