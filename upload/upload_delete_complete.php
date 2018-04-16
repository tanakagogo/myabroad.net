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


//ぴっクエスト画像削除エンジン
$delete_message ='';
if(isset($_SESSION['pic_del_id'])){
	$_SESSION = checkInput($_SESSION);

	$pic_del_id = (isset($_SESSION['pic_del_id'])) ? $_SESSION['pic_del_id'] : null;
	$pic_del_id = trim($pic_del_id);
	$pic_del_id = intval($pic_del_id);

	$sql4		= "update new_pic_table set delete_flag = 1 where id = $pic_del_id";//フォルダに入った実画像を削除するためにnameを得る。
	$result4	= $mysqli->query($sql4);
	// $rs4		= $result4->fetch_assoc();
/*
echo '<pre>';
var_dump(realpath('../user_img/'));
var_dump($rs4);
echo '</pre>';
*/

/*	$sql3 = "delete from new_pic_table";
	$where3 = sprintf(' where id=%d',$pic_del_id);
	$result3 = $mysqli->query($sql3.$where3);*/
	$delete_message = "";
	if($result4){
		// unlink(realpath('../user_img/').'/'.$rs4['name']);
		$delete_message = "ぴっクエストナンバー：{$pic_del_id}を削除しました。";
	}else{
		$delete_message = "削除できませんでした。";
	}
	$_SESSION['delete_message'] = $delete_message;
}
require_once('upload_delete_complete_view.php');

?>
