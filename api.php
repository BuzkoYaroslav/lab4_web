<?php 
require_once("utils/functions.php");
require_once("utils/errors.php");
require_once("actions/data.php");
require_once("actions/user.php");

echo handleQuery();
	
function handleQuery() {
	set_exception_handler('handleException');
	set_error_handler('handleError');

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$action = $_GET[ACTION_KEY];
		$code = validateAction($action);

		if (($code = validateAction($action)) != OK_ID) {
            return jsonFromErrorCode($code);
		}

		$method = $_GET[METHOD_KEY];
		if (($code = validateMethod($method)) != OK_ID) {
			return jsonFromErrorCode($code);
		}


		switch ($method) {
			case LOGIN_METHOD:
				$username = $_GET[USERNAME_KEY];
				$password = $_GET[PASSWORD_KEY];

				return login($username, $password);
				break;
			case LOGOUT_METHOD:
				$sessionId = $_GET[SESSION_ID_KEY];

				return logout($sessionId);
				break;
			case SET_USER_DATA_METHOD:
				$sessionId = $_GET[SESSION_ID_KEY];
				$text = $_GET[TEXT_KEY];

                return setUserText($sessionId, $text);
				break;
			case GET_USER_DATA_METHOD:
				$sessionId = $_GET[SESSION_ID_KEY];

                return getUserText($sessionId);
				break;
			default:
				throw new Exception(UNKNOWN_EXCEPTION);
				break;
		}
	}
}

?>