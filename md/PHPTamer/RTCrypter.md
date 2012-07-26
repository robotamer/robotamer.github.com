RTCrypter
=========

RTCrypter allows for encryption and decryption on the fly using a simple but effective method.

RTCrypter does not require mcrypt, mhash or any other PHP extension, it uses only PHP.



	$crypt = new RTCrypter();
	$crypt->setCharacters('#@|*-+.,!~`$%^&<>{}[]()0/\123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
	$secretKey = $crypt->genKey();
	

	$crypt = new RTCrypter();
	$crypt->useBase64(FALSE); // TRUE is default
	$crypt->setCharacters('#@|*-+.,!~`$%^&<>{}[]()0/\123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
	$crypt->setScramble($secretKey);

