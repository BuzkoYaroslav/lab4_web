<?php
const OK_ID = 0;
const UNKNOWN_ACTION_ID = 1;
const UNKNOWN_METHOD_ID = 2;
const INCORRECT_INPUT_ID = 3;

const INCORRECT_PASSWORD_ID = 4;
const UNKNOWN_SESSION_NAME_ID = 5;

const UNKNOWN_USERNAME_ID = 6;

const E_WARNING_STRING = "";
const E_NOTICE_STRING = "";
const E_USER_ERROR_STRING = "";
const E_USER_WARNING_STRING = "";
const E_USER_NOTICE_STRING = "";
const E_RECOVERABLE_ERROR_STRING = "";
const E_ALL_STRING = "";

require_once("utils/functions.php");

function eMessageFromCode($code) {
	switch ($code) {
			case UNKNOWN_ACTION_ID:
				return unknownDataFor(ACTION_KEY);
				break;
			case UNKNOWN_METHOD_ID:
				return unknownDataFor(METHOD_KEY);
				break;
			case INCORRECT_INPUT_ID:
				return incorrectDataFor(INPUT_TEXT);
				break;
			case INCORRECT_PASSWORD_ID:
				return incorrectDataFor(PASSWORD_KEY);
				break;
			case UNKNOWN_SESSION_NAME_ID:
				return unknownDataFor(SESSION_ID_KEY);
				break;	
			case UNKNOWN_USERNAME_ID:
				return unknownDataFor(USERNAME_KEY);
				break;	
			default:
				return unknownDataFor(EXCEPTION_TEXT);
				break;
		}
}

function jsonFromErrorCode($code) {
	$responseString = eMessageFromCode($code);

	return json_encode(array(ERROR_MESSAGE_KEY => $responseString));
}

function handleException($exception) {
	echo "<p>Exception occured!<br>" . 
	     "Message:" . $exception->errorMessage() . "</p>";
}
function handleError($level, $message, $file = "Unknown", $line = -1, $context = "") {
	echo "<p>Error occured! Level: " . getStingFromErrorLevel($level) . "<br>" .
	     "Message: " . $message . "<br>" .
	     "File: " . $file . " , Line: " . $line . "</p>";

	die();
}

function getStingFromErrorLevel($level) {
	switch ($level) {
		case E_WARNING:
			return E_WARNING_STRING;
			break;
	    case E_NOTICE:
			return E_NOTICE_STRING;
			break;
		case E_USER_ERROR:
			return E_USER_ERROR_STRING;
			break;
		case E_USER_WARNING:
			return E_USER_WARNING_STRING;
			break;
		case E_USER_NOTICE:
			return E_USER_NOTICE_STRING;
			break;
		case E_RECOVERABLE_ERROR:
			return E_RECOVERABLE_ERROR_STRING;
			break;
		case E_ALL:
			return E_ALL_STRING;
			break;
		default:
			return UNKNOWN_ERROR_STRING;
			break;
	}
}

function unknownDataFor($input) {
	return "Unknown " . $input . "!";
}

function incorrectDataFor($input) {
	return "Incorrect " . $input . "!";
}

 ?>