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

//MｙSQLとの接続
require_once("../setting/connect.php");

//h,checkInput関数読み込み
require_once("../setting/functions.php");
$_GET = checkInput($_GET);

// if(isset($_GET['id'])){
	$delete_picquest_id 	= (isset($_GET['id'])) ? $_GET['id'] : null;
	$delete_picquest_id 	= trim($delete_picquest_id);
	$delete_picquest_id 	= intval($delete_picquest_id);

	$_SESSION['picquest_id'] = $delete_picquest_id;
	$_SESSION['delete_picquest_id'] = $delete_picquest_id;

	$sql = "select * from new_picquest where id = {$delete_picquest_id}";
	$result = $mysqli->query($sql);
	$rs = $result->fetch_assoc();
// }
	// echo '<pre>';
	// var_dump($_GET);
	// var_dump($_SESSION['picquest_id']);
	// var_dump($delete_flag_rs);
	// echo '</pre>';
require_once("picquest_delete_confirm_view.php");

?>
