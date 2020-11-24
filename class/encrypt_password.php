<?php

class encPass{
	public function encrypt( $password ){
		$method = '$6$'; // SHA512
		$rounds = 'rounds=1200'; // how many times the hashing loop should be executed
		$salt = '$emailsystem$';
		$hash = $method . $rounds . $salt;

		$hashed_password = crypt($password, $hash);

		return $hashed_password;
	}
}

?>