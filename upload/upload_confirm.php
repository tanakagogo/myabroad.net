<?php
session_start();

//h,checkInput関数読み込み
require_once("../setting/functions.php");
$_POST = checkInput($_POST);

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

//変数代入処理
$temporary_file_path 	= isset($_FILES['userfile']['tmp_name']) ? $_FILES['userfile']['tmp_name'] : null;
$name 					= isset($_FILES['userfile']['name']) ? $_FILES['userfile']['name'] : null;
$picquest_id 			= isset($_SESSION['picquest_id']) ? $_SESSION['picquest_id'] : null;
$comment 				= isset($_POST['comment']) ? $_POST['comment'] : null;
$picquest 				= isset($_SESSION['picquest']) ? $_SESSION['picquest'] : null;

$temporary_file_path 	= trim($temporary_file_path);
$name 					= trim($name);
$picquest_id 			= trim($picquest_id);
$comment 				= trim($comment);
$picquest 				= trim($picquest);

//エラーメッセージ変数代入
$error_message ='';
$back_btn = '';
$moving_file = '';

//コメントに記入がない場合
if($comment == ""){
	$error_message = 'コメントは是非是非書いてくださ～い。この画面でも修正できます(再度の確認はできません)。';
	$back_btn = '<a href="../picquest/each_picquest.php" onclick="if(history.length){history.back(); return false;}">登録画面に戻る</a>';
}

//アップロード画像のチェック
$link_path = '';
if(isset($_FILES['userfile']['type'])
&&
(//条件文
$_FILES['userfile']['type'] == "image/jpeg"//条件文
|| $_FILES['userfile']['type'] == "image/jpg"//条件文
|| $_FILES['userfile']['type'] == "image/png"//条件文
|| $_FILES['userfile']['type'] == "image/gif"//条件文
)){
	// ファイルの移動実行
	$upload_file_name = realpath('../user_img/').'/'.$name;
	if(is_uploaded_file($temporary_file_path)){
		$moving_file = move_uploaded_file($temporary_file_path, $upload_file_name);
		$link_path = '../user_img/'.$name;
	}else{
		$error_message = '画像ファイルをアップロードしなおしてください。';
	}
}else{
	$error_message = '画像ファイルではないかもしれません。';
	// $back_btn = '<a href="../picquest/each_picquest.php" onclick="if(history.length){history.back(); return false;}">登録画面に戻る</a>';
}
// $moving_file = isset($_SESSION['moving_file']) ? $_SESSION['moving_file'] : null;


$_SESSION['name'] 					= $name;
$_SESSION['picquest_id']			= $picquest_id;
$_SESSION['comment'] 				= $comment;
$_SESSION['link_path'] 				= $link_path;
$_SESSION['moving_file'] 			= $moving_file;

// var_dump($_SESSION['link_path']);

$name 					= h($name);
$picquest_id 			= h($picquest_id);
$comment 				= h($comment);


require_once ('upload_confirm_view.php');
?>

