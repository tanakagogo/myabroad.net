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

//MｙSQLとの接続
require_once("../setting/connect.php");

/*画像アップロードエンジン*/
$picquest_id			= isset($_SESSION['picquest_id']) ? $_SESSION['picquest_id'] : null;
$name 					= isset($_SESSION['name']) ? $_SESSION['name'] : null;
$temporary_file_path 	= isset($_SESSION['temporary_file_path']) ? $_SESSION['temporary_file_path'] : null;
$link_path 				= isset($_SESSION['link_path']) ? $_SESSION['link_path'] : null;
$comment 				= isset($_SESSION['comment']) ? $_SESSION['comment'] : null;
$picquest 				= isset($_SESSION['picquest']) ? $_SESSION['picquest'] : null;
$moving_file 			= isset($_SESSION['moving_file']) ? $_SESSION['moving_file'] : null;

$picquest_id			= trim($picquest_id);
$name 					= trim($name);
$temporary_file_path 	= trim($temporary_file_path);
$link_path 				= trim($link_path);
$comment 				= trim($comment);
$picquest 				= trim($picquest);
$moving_file 			= trim($moving_file);


/*	echo '<pre>';
	var_dump($_SESSION);
	echo '</pre>';*/

	// $str_pic_name = strval($_FILES['userfile']['name']);
	// $str_link_path = strval("user_img/".$_FILES['userfile']['name']);
if($comment && $moving_file){
	$sql = <<<EOS
	insert into new_pic_table(
			name,
			link_path,
			comment,
			picquest_id
		) values (
			'$name',
			'$link_path',
			'$comment',
			'$picquest_id'
		)
EOS;
		$result = $mysqli->query($sql);
}else{
	$error_message = '画像がないか、コメントが入力されていません。'.'<br><a href="../picquest/each_picquest.php" onclick="location.href("../picquest/each_picquest.php");">→登録画面に戻る</a>';
}


		if($result==true){
			$upload_message = "ぴっクエストの投稿が完了しました。";
		}else{
			die($mysqli->error);
			$upload_message = "ファイルが選択されていません。";
		}

$_SESSION = array();
session_destroy();

require_once ('upload_complete_view.php');
?>

