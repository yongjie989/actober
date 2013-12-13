<?php
include "inc/rain.tpl.class.php";
raintpl::configure("base_url", null );
raintpl::configure("tpl_dir", "tpl/" );
raintpl::configure("cache_dir", "tmp/" );
$tpl = new RainTPL;


//$country_list = array('Brunei','Cambodia','Indonesia','Laos','Malaysia','Myanmar(Burma)','Philippines','Singapore','Thailand','Vietnam');
//$tpl->assign("country_list",$country_list);

if($_GET['page']){

	
	$tpl->draw($_GET['page']);
}else{
	header('Location: /index.php');

};
?>