<?php
// session_start();
class CsrfValidator{

	const HASH_ALGO = 'sha256';
	public static function generate(){
		if(session_status() === PHP_SESSION_NONE){
			throw new BadMethodCallException('Session is not active.');
		}
		return hash(self::HASH_ALGO,session_id());
	}

	public static function validate($token,$throw = false){
		$success = $_SESSION['hash_id'] === $token;
		// $success = self::generate() === $token;
		if(!$success && $throw){
			throw new RuntimeException('CSRF validation failed!',400);
		}
		//echo "csrf validate OK!";
		return $success;
	}

}
?>
