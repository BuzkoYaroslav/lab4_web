<?php

$availableUsers = array(array(USERNAME_KEY => "JohnSmith", PASSWORD_KEY => "12345qwerty"),
	                    array(USERNAME_KEY => "Vasiaa", PASSWORD_KEY => "qwerty"),
	                    array(USERNAME_KEY => "Lenya", PASSWORD_KEY => "123sd"),
	                    array(USERNAME_KEY => "petka", PASSWORD_KEY => "ppqwew"),
	                    array(USERNAME_KEY => "dimka", PASSWORD_KEY => "asdasd12"),
	                    array(USERNAME_KEY => "zenya", PASSWORD_KEY => "pppert"),
	                    array(USERNAME_KEY => "yarikker", PASSWORD_KEY => "yarik1100"));


require_once("utils/functions.php");

function userExist($username) {
	foreach ($GLOBALS['availableUsers'] as $user) {
		if ($username === $user[USERNAME_KEY])
			return TRUE;
	}

	return FALSE;
}
function correctPassword($username, $password) {
	if (!userExist($username))
		return FALSE;

	foreach ($GLOBALS['availableUsers'] as $user) {
		if ($username === $user[USERNAME_KEY] &&
			$password === $user[PASSWORD_KEY])
			return TRUE;
	}

	return FALSE;
}


 ?>