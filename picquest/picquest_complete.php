<?php
session_start();
// session_regenerate();

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

// $_POSTの処理
require_once('../setting/functions.php');
checkInput($_POST);
$picquest = (isset($_POST['picquest'])) ? $_POST['picquest'] : null;
$picquest = trim($picquest);

//MｙSQLとの接続
require_once("../setting/connect.php");

if(!$_POST['picquest'] == ''){
	$sql = <<<EOS
	insert into new_picquest (picquest) values ('$picquest')
EOS;

	$result = $mysqli->query($sql);
	if($result){
		$insert_comment = "ぴっクエストの投稿が完了しました。";
	}
	$mysqli->close();
}else{
		$insert_comment = "ぴっクエストが入っていません。";
	}

require_once ('picquest_complete_view.php');
?>
