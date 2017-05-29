<?php

const TEMPLATE_SESSION_ID = array(5, 4, 2, 10);

require_once("utils/functions.php");
require_once("utils/errors.php");

function login($username, $password) {
	$response = array(ERROR_MESSAGE_KEY => null, SESSION_ID_KEY => null);

	if (($code = validateUsername($username)) != OK_ID) {
		$response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
		return json_encode($response);
	}

	if (($code = validatePassword($username, $password)) != OK_ID) {
		$response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
		return json_encode($response);
	}

	try {
        $sessionId = "";
        $fileName = "";

        do {
        	$sessionId = generateSessionId();
        	$fileName = "internal/sessions/" . $sessionId . ".txt";
        } while (file_exists($fileName));

        $file = fopen($fileName, "a+");

        fwrite($file, $username);

        $response[SESSION_ID_KEY] = $sessionId;
	}
	catch (Exception $e) {
		$response[ERROR_MESSAGE_KEY] = $e->getMessage();
	}
	 finally {
    	fclose($file);
    }

	
	return json_encode($response);
}

function logout($sessionId) {
	$response = array(ERROR_MESSAGE_KEY => null);

	if ($code = validateSessionId($sessionId) != OK_ID) {
		$response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
		return json_encode($response);
	}

	try {
		$fileName = "internal/sessions/" . $sessionId . ".txt";
		unlink($fileName);
	} 
	catch (Exception $e) {
        $response[ERROR_MESSAGE_KEY] = $e->getMessage();
	}


	return json_encode($response);
}

function generateSessionId() {
	$id = "";
	for ($i = 0; $i < count(TEMPLATE_SESSION_ID); $i++) {
		for ($j = 0; $j < TEMPLATE_SESSION_ID[$i]; $j++) {
			$id .= generateChar();
		}

		if ($i != count(TEMPLATE_SESSION_ID) - 1) 
			$id .= '-';
	}

	return $id;
}
function generateChar() {
	if (rand(0, 1) == 0) {
		return chr(rand(ord('a'), ord('z')));
	} else {
		return rand(0, 9);
	}
}

?>