<?php
session_start();
define("CONFIG", "../config/");
define("SRC", "../src/");
define("LOG", "../logs/");
define('ROOT', str_replace("\\", "/", realpath(dirname(__FILE__).'/../')));
define("UPLOAD", ROOT."/web/upload/imgs/");

$ini = parse_ini_file(CONFIG."tournament.ini", true);


define("MAXFILESIZE", $ini['max_file_size']);



include_once SRC."utils/Main.php";

new Main();

?>