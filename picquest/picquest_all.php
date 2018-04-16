<?php
session_start();

//CSRF対策：最初の暗号化
const HASH_ALGO = 'sha256';
if(!isset($_SESSION['hash_id'])){
	$_SESSION['hash_id'] = hash(HASH_ALGO,session_id());
}

//CSRF対策：クラスの読み込み
require_once("../class/CsrfValidator.php");

//CSRF対策：実行タイミング
if(isset($_POST['comment'])){
	try {
	CsrfValidator::validate(filter_input(INPUT_POST, 'token'), true);
	//echo "ヴァリデートを通っています。";
	$_POST[] = "";
	} catch (\RuntimeException $e) {
		header('Content-Type: text/plain; charset=UTF-8', true, $e->getCode() ?: 500);
		die($e->getMessage());
	}
}

//h,checkInput関数読み込み
require_once("../setting/functions.php");

//MｙSQLとの接続
require_once("../setting/connect.php");


//ぴっクエスト表示エンジン

//ぴっクエスト表示
$sql = <<<EOS
select * from new_picquest where delete_flag != 1 order by id desc
EOS;
$result = $mysqli->query($sql);
while($resultSet = $result->fetch_assoc()){
	$temp[] = $resultSet;
}
$picquest_rs = $temp;

//フェイク数計算
$fake = 0;//総：数変数初期化
$n = 3;//列数：変数初期化
$enough = count($picquest_rs) % $n;
if($enough != 0){
	$fake = $n - (count($picquest_rs) % $n);
}

//ぴっク件数表示

//ぴっクエストid取得
$sql3 = 'select id from new_picquest where delete_flag != 1 order by id desc';
$result3 = $mysqli->query($sql3);

//ぴっク件数取得
while($picquest_id = $result3->fetch_assoc()){
$picquest_id = intval($picquest_id['id']);

$sql4 = "select * from new_pic_table where picquest_id = $picquest_id and delete_flag != 1";
$result4 = $mysqli->query($sql4);
$resultSet4[] = $result4->num_rows;
}

//過去のぴクエスト
$sql2 = <<<EOS
select * from new_picquest where delete_flag = 1 order by id desc
EOS;
$result2 = $mysqli->query($sql2);
while($resultSet2 = $result2->fetch_assoc()){
	$temp2[] = $resultSet2;
}
$picquest_rs2 = $temp2;

//フェイク数計算
$fake2 = 0;//総：数変数初期化
$enough2 = count($picquest_rs2) % $n;
if($enough2 != 0){
	$fake2 = $n - (count($picquest_rs2) % $n);
}

//過去のぴっク件数取得
$sql6 = <<<EOS
select id from new_picquest where delete_flag = 1 order by id desc
EOS;
$result6 = $mysqli->query($sql6);
while($resultSet6 = $result6->fetch_assoc()){
	$picquest_id = intval($resultSet6['id']);

	$sql5 = "select * from new_pic_table where picquest_id = $picquest_id and delete_flag != 1";
	$result5 = $mysqli->query($sql5);
	$resultSet5[] = $result5->num_rows;
}




/*	echo '<pre>';
	var_dump($sql4);
	var_dump($sql2.$where2.$where2_2.$order);
	// var_dump($_SESSION);
	echo '</pre>';*/

require_once ('picquest_all_view.php');
?>

