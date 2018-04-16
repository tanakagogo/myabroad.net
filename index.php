<?php
session_start();

//CSRF対策：最初の暗号化
const HASH_ALGO = 'sha256';
if(!isset($_SESSION['hash_id'])){
	$_SESSION['hash_id'] = hash(HASH_ALGO,session_id());
}

//CSRF対策クラスの読み込み
require_once("class/CsrfValidator.php");

//CSRF対策：実行タイミング
if(isset($_POST['picquest'])){
	try {
	CsrfValidator::validate(filter_input(INPUT_POST, 'token'), true);
	//echo "ヴァリデートを通っています。";
	$_POST[] = "";
	} catch (\RuntimeException $e) {
		header('Content-Type: text/plain; charset=UTF-8', true, $e->getCode() ?: 500);
		die($e->getMessage());
	}
}

//訪問回数モーダルの実行有無
if(!isset($_SESSION['count'])){
	$_SESSION['count'] = 1;
}else{
	$_SESSION['count']++;
}

require_once ('index_view.php');
?>

