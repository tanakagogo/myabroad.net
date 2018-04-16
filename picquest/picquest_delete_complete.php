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

//ぴっクエスト削除エンジン
if(isset($_SESSION['delete_picquest_id'])){
$picquest_id 	= (isset($_SESSION['delete_picquest_id'])) ? $_SESSION['delete_picquest_id'] : null;
$picquest_id 	= trim($picquest_id);
$picquest_id 	= intval($picquest_id);

$sql = "update new_picquest set delete_flag = 1 where id = {$picquest_id}";
$result = $mysqli->query($sql);
/*
echo '<pre>';
var_dump($sql);
echo '</pre>';*/

	$delete_message = "";
	if($result){
		$delete_message = "ぴっクエストナンバー：{$picquest_id}を削除しました。";
	}else{
		$delete_message = "削除できませんでした。";
	}
	$_SESSION['delete_message'] = $delete_message;
}

//h,checkInput関数読み込み
require_once("../setting/functions.php");

require_once('picquest_delete_complete_view.php');
?>
