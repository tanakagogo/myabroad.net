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

//h,checkInput関数読み込み
require_once("../setting/functions.php");

//MｙSQLとの接続
require_once("../setting/connect.php");

$_GET = checkInput($_GET);
/*
echo '<pre>';
var_dump($_GET);
echo '</pre>';*/

if(isset($_GET['pic_del_id'])){
	$delete_pic_id 	= (isset($_GET['pic_del_id'])) ? $_GET['pic_del_id'] : null;
	$delete_pic_id 	= trim($delete_pic_id);
	$delete_pic_id 	= intval($delete_pic_id);

	$_SESSION['pic_del_id'] = $delete_pic_id;

	$sql = "select * from new_pic_table where id = {$delete_pic_id}";
	$result = $mysqli->query($sql);
	$rs = $result->fetch_assoc();
}

$picquest_id 	= (isset($_SESSION['picquest_id'])) ? $_SESSION['picquest_id'] : null;
$picquest 		= (isset($_SESSION['picquest'])) ? $_SESSION['picquest'] : null;
// $name 			= (isset($_SESSION['name'])) ? $_SESSION['name'] : null;
// $link_path 		= (isset($_SESSION['link_path'])) ? $_SESSION['link_path'] : null;
// $comment 		= (isset($_SESSION['comment'])) ? $_SESSION['comment'] : null;

$picquest_id 	= trim($picquest_id);
$picquest 		= trim($picquest);
// $name 			= trim($name);
// $link_path 		= trim($link_path);
// $comment 		= trim($comment);

require_once('upload_delete_confirm_view.php');

?>
