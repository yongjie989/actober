<?php
$db = sqlite_popen('actober.db', 0666, $sqliteerror);
$custom_uploaddir = 'E:/actober/custom_upload/';


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

$SQL="create table actober_tshirt_custom_images(
	userid text,
	product_id text,
	painter_id text,
	image_path text
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
			$json[] = array('number'=> substr('00000'.$i,-2)) + $row;
			$i++;
		}
		echo json_encode($json);
		exit;
	};
	echo 'failure';
	exit;
};

if($_GET['act'] == 'get_custom_upload_images'){
	$userid = $_GET['userid'];
	$productid = $_GET['productid'];
	$painterid = $_GET['painterid'];
	if($userid && $productid ){
		$SQL = "select * from actober_tshirt_custom_images where userid='".$userid."' and product_id='".$productid."' "; //and painter_id='".$painterid."'
		$query = sqlite_query($db, $SQL);
		$json = array();
		$i=0;
		while ($row = sqlite_fetch_array($query, SQLITE_ASSOC)) {
			$json[] = array('number'=> substr('00000'.$i,-2)) + $row;
			$i++;
		}
		echo json_encode($json);
		exit;
	};
	echo 'failure';
	exit;
};

if($_POST['act'] == 'process_custom_upload'){

	$userid = $_POST['userid'];
	$productid = $_POST['productid'];
	$painterid = $_POST['painterid'];
	$file_0 = $_FILES['custom_upload_files_0'];
	$file_1 = $_FILES['custom_upload_files_1'];
	$file_2 = $_FILES['custom_upload_files_2'];
	$file_3 = $_FILES['custom_upload_files_3'];
	$file_4 = $_FILES['custom_upload_files_4'];
	
	if($userid && $productid && $painterid){
		for($i=0;$i<5;$i++){
			$f = ${'file_'. $i};
			if($f['tmp_name']){
				$SQL = 'insert into actober_tshirt_custom_images values ("'.$userid.'","'.$productid.'","'.$painterid.'","'.basename($f['name']).'")';
				sqlite_query($db, $SQL);
				$uploadfile = $custom_uploaddir . basename($f['name']);
				$msg ='' . basename($f['name']);
				copy($f['tmp_name'], $uploadfile);
			};
		};
	};
	/*
	$i = 0;
	$f = ${'file_'. $i};
	$uploadfile = $custom_uploaddir . basename($f['name']);
	copy($f['tmp_name'], $uploadfile);
	*/
	//$msg = 'Name = '.basename($f['name']).' Size = '.filesize($f['tmp_name']);
	echo "{error:'',msg:'$msg'}";
	exit;
};

if($_GET['act'] == 'sql'){
	/*
	$SQL="create table actober_tshirt_custom_images(
	userid text,
	product_id text,
	painter_id text,
	image_path text
	)";
	sqlite_query($db, $SQL);
	*/
};

function print_phpinfo(){
	$fp = fopen('info.html', 'w');
	ob_start();
	phpinfo();
	$info = ob_get_contents();
	ob_end_clean();
	fwrite($fp, $info);
	fclose($fp);
};

sqlite_close($db);
?>