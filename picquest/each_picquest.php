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
if(isset($_POST['action'])||isset($_POST['comment'])){
	try {
	CsrfValidator::validate(filter_input(INPUT_POST, 'token'), true);
	//echo "ヴァリデートを通っています。";
	$_POST[] = "";
	} catch (\RuntimeException $e) {
		header('Content-Type: text/plain; charset=UTF-8', true, $e->getCode() ?: 500);
		die($e->getMessage());
	}
}

$picquest_id 	= (isset($_SESSION['picquest_id'])) ? $_SESSION['picquest_id'] : null;
$name 			= (isset($_SESSION['name'])) ? $_SESSION['name'] : null;
$link_path 		= (isset($_SESSION['link_path'])) ? $_SESSION['link_path'] : null;
$comment 		= (isset($_SESSION['comment'])) ? $_SESSION['comment'] : null;

$picquest_id 	= trim($picquest_id);
$name 			= trim($name);
$link_path 		= trim($link_path);
$comment 		= trim($comment);

//h,checkInput関数読み込み
require_once("../setting/functions.php");

//MｙSQLとの接続
require_once("../setting/connect.php");

//ぴっクエスト表示エンジン
// $delete_message ='';
// if(isset($_GET['id']) || isset($_SESSION['picquest_id'])){
	$_GET = checkInput($_GET);
	$picquest_id = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['picquest_id'];
	$picquest_id = trim($picquest_id);
	$picquest_id = intval($picquest_id);


	$sql = "select picquest from new_picquest";
	$where = sprintf(' where id=%d',$picquest_id);
	$result = $mysqli->query($sql.$where);
	$picquest_rs = $result->fetch_assoc();

//delete_flagが立っているぴっクエストかの判定
	$sql_delete_flag = "select delete_flag from new_picquest";
	$where = sprintf(' where id=%d',$picquest_id);
	$result_delete_flag = $mysqli->query($sql_delete_flag.$where);
	$delete_flag_rs = $result_delete_flag->fetch_assoc();


	// echo '<pre>';
	// var_dump($_GET);
	// var_dump($_SESSION['picquest_id']);
	// var_dump($delete_flag_rs);
	// echo '</pre>';

//画像件数表示エンジン
	$sql4 = "select * from new_pic_table where picquest_id = $picquest_id and delete_flag != 1";
	$result4 = $mysqli->query($sql4);
	$resultSet4 = $result4->num_rows;

	$_SESSION['picquest_id'] = $picquest_id;
	$_SESSION['picquest'] = $picquest_rs['picquest'];

//画像表示用エンジン
	$sql2 = "select * from new_pic_table";
	$where2 = sprintf(' where picquest_id=%d',$picquest_id);
	$where2_2 =' and delete_flag != 1';
	$order = " order by id desc";
	$result2 = $mysqli->query($sql2.$where2.$where2_2.$order);


	$search_message = '';
	if(!$result2->num_rows){
		// $picquest_rs2 = array();
		$search_message = 'まだぴっクエストされた画像はありません。あなたが一番乗りでぴっクエストに応えましょう！'.'<br>';
	}
// }

//ぴっクエスト画像削除メッセージ受け取り
$delete_message = isset($_SESSION['delete_message']) ? $_SESSION['delete_message'] : null;

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
require_once ('each_picquest_view.php');
?>
