<?php 
require_once("utils/functions.php");
require_once("utils/errors.php");

function getUserText($sessionId) {
	$response = array(ERROR_MESSAGE_KEY => null, TEXT_KEY => null);

    if (($code = validateSessionId($sessionId)) != OK_ID) {
    	$response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
    	return json_encode($response);
    }
    try {
        $username = getUserName($sessionId);

        if (($code = validateUsername($username)) != OK_ID) {
            $response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
    	    return json_encode($response);    
        }

        $fileName = "internal/data/" . $username . ".txt";
        if (file_exists($fileName)) {
        	$file = fopen($fileName, "r");

        	$response[TEXT_KEY] = fread($file, filesize($fileName));

        	fclose($file);
        } 
    } catch(Error $e) {
    	$response[ERROR_MESSAGE_KEY] = $e->getMessage();
    }

    return json_encode($response);
}

function getUserName($sessionId) {
	$fileName = "internal/sessions/" . $sessionId . ".txt";
    $file = fopen($fileName, "r");

    $name = fgets($file);

    fclose($file);

    return $name;
}

function setUserText($sessionId, $text) {
    $response = array(ERROR_MESSAGE_KEY => null);

    if (($code = validateSessionId($sessionId)) != OK_ID) {
    	$response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
    	return json_encode($response);
    }
    try {
        $username = getUserName($sessionId);

        if (($code = validateUsername($username)) != OK_ID) {
            $response[ERROR_MESSAGE_KEY] = eMessageFromCode($code);
    	    return json_encode($response);    
        }

        $fileName = "internal/data/" . $username . ".txt";
        $file = fopen($fileName, "a+");

        fwrite($file, $text);
        
    } catch(Exception $e) {
    	$response[ERROR_MESSAGE_KEY] = $e->getMessage();
    } finally {
    	fclose($file);
    }

    return json_encode($response);
}

?>