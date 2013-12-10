<?php
$db = sqlite_popen('actober.db', 0666, $sqliteerror);

/*
$SQL="create table actober_tshirt_spec(
	userid text,
	product_id text, -- 04650
	product_name text, -- Ice Grey
	product_sizes text, -- S, M, L, XL, XXL, XXXL, XXXXL
	product_range text, -- S-4XL
	product_decoration text, -- Screen Printing or other 
	product_minQty integer, -- 6
	product_category_id integer
)";

$SQL="create table actober_tshirt_color(
	userid text,
	product_id text,
	color text
)";
sqlite_query($db, $SQL);
*/
/*
$color = array('#ffffff','#000000','#B6B6B4','#1569C7','#38ACEC','#50EBEC','#52D017','#FDD017','#C85A17','#E41B17','#E4287C','#6C2DC7','#7D0552','#990012','#D4A017');
while(list($k, $v) = each($color)){
	$SQL="insert into actober_tshirt_color values('1','1','".$v."')";
	sqlite_query($db, $SQL);
};
*/

//$country_list = array('Brunei','Cambodia','Indonesia','Laos','Malaysia','Myanmar(Burma)','Philippines','Singapore','Thailand','Vietnam');
//$tpl->assign("country_list",$country_list);

/*
* Get T-Shirt color list by product ID
* webapi.php?act=get_tshirt_color&userid=1&productid=1
*/
if($_GET['act'] == 'get_tshirt_color'){
	$userid = $_GET['userid'];
	$productid = $_GET['productid'];
	if($userid && $productid){
		$SQL = "select * from actober_tshirt_color where userid='".$userid."' and product_id='".$productid."'";
		$query = sqlite_query($db, $SQL);
		$json = array();
		$i=0;
		while ($row = sqlite_fetch_array($query, SQLITE_ASSOC)) {
			$json[] = $row + array('number'=> substr('00'.$i,-2));
			$i++;
		}
		echo json_encode($json);
		exit;
	};
	echo 'failure';
	exit;
};


sqlite_close($db);
?>