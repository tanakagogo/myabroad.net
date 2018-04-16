<?php
session_start();

//CSRF対策：最初の暗号化
const HASH_ALGO = 'sha256';
if(!isset($_SESSION['hash_id'])){
	$_SESSION['hash_id'] = hash(HASH_ALGO,session_id());
}

//デバッグ
/*echo '<pre>';
var_dump($_SESSION);
var_dump($_POST);
echo '</pre>';
*/
//CSRF対策：クラスの読み込み
require_once("../class/CsrfValidator.php");

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

require_once('../setting/functions.php');
checkInput($_POST);
$picquest = (isset($_POST['picquest'])) ? $_POST['picquest'] : null;
$picquest = trim($picquest);
$picquest = h($picquest);
// var_dump($picquest);
$_SESSION['picquest'] = $picquest;

require_once('picquest_confirm_view.php');
?>
