<?php
/*
session_start();

$_SESSION['country'] = 'Malaysia';
$_SESSION['city'] = 'Kuala Lumpur';
$_SESSION['locality'] = 'ALL';
date_default_timezone_set('Asia/Kuala_Lumpur');
*/
include "inc/rain.tpl.class.php";
raintpl::configure("base_url", null );
raintpl::configure("tpl_dir", "tpl/" );
raintpl::configure("cache_dir", "tmp/" );
$tpl = new RainTPL;

$country_list = array('Brunei','Cambodia','Indonesia','Laos','Malaysia','Myanmar(Burma)','Philippines','Singapore','Thailand','Vietnam');
$tpl->assign("country_list",$country_list);

$tpl->draw("index");
?>