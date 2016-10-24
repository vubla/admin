<?php

if($_GET['controller'] == 'bugzilla'){
    header('Location: https://admin.vubla.com/bugzilla/index.cgi');
}
if($_GET['controller'] == 'xref'){
    header('Location: https://admin.vubla.com/xref/output/index.html');
}
header('Content-Type: text/html; charset=UTF-8');
error_reporting(-1);
//ini_set('display_errors', 'on');

require_once('../config_admin.php');
require_once CLASS_FOLDER. '/autoload.php';

Autoload::init();
$_GET['iso'] = 'en';
Language::init();


$framework = new VublaFramework();

$framework->start(false);





