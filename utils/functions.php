<?php 
//required constants
const USER_ACTION = "user";
const DATA_ACTION = "data";

const LOGIN_METHOD = "login";
const LOGOUT_METHOD = "logout";
const SET_USER_DATA_METHOD = "set";
const GET_USER_DATA_METHOD = "get";

const ACTION_KEY = "action";
const METHOD_KEY = "method";
const USERNAME_KEY = "username";
const PASSWORD_KEY = "password";
const SESSION_ID_KEY = "sessionId";
const TEXT_KEY = "text";
const ERROR_MESSAGE_KEY = "errorMessage";

const INPUT_TEXT = "input data";

const ERROR_TEXT = "error";
const EXCEPTION_TEXT = "exception";

require_once("internal/available-users.php");
require_once("utils/errors.php");

function validateAction($action) {
	if (empty($action)) {
		return INCORRECT_INPUT_ID;
	}

	if ($action != USER_ACTION &&
		$action != DATA_ACTION) {
		return UNKNOWN_ACTION_ID;
	}

	return OK_ID;
}
function validateMethod($method) {
	if (empty($method)) {
		return INCORRECT_INPUT_ID;
	}
	if ($method != LOGIN_METHOD &&
		$method != LOGOUT_METHOD &&
		$method != SET_USER_DATA_METHOD &&
		$method != GET_USER_DATA_METHOD) {
		return UNKNOWN_METHOD_ID;
	}

	return OK_ID;
}
function validateUsername($username) {
	if (empty($username)) {
		return INCORRECT_INPUT_ID;
	}

	if (!userExist($username)) {
		return UNKNOWN_USERNAME_ID;
	}
	
	return OK_ID;
}
function validatePassword($username, $password) {
    if (empty($username) ||
    	empty($password)) {
        return INCORRECT_INPUT_ID;
    }

    if (!correctPassword($username, $password)) {
    	return INCORRECT_PASSWORD_ID;
    }

    return OK_ID;
}
function validateSessionId($sessionId) {
    if (empty($sessionId)) {
    	return INCORRECT_INPUT_ID;
    }

    $fileName = "internal/sessions/" . $sessionId . ".txt";

    if (!file_exists($fileName)) {
    	return UNKNOWN_SESSION_NAME_ID;
    }

    return OK_ID;
}



 ?>