<?php
session_start();
$con=mysqli_connect("localhost","root","","realstate");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/RealState/');
define('SITE_PATH','http://127.0.0.1/RealState/');

define('PROPERTY_IMAGE_SERVER_PATH',SERVER_PATH.'media/poperty/');
define('PROPERTY_IMAGE_SITE_PATH',SITE_PATH.'media/poperty/');

define('BANNER_SERVER_PATH',SERVER_PATH.'media/banner/');
define('BANNER_SITE_PATH',SITE_PATH.'media/banner/');


?>