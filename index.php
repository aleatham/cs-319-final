<?php
define('APP_ROOT', __DIR__ . '/');
define('CONFIG_PATH', APP_ROOT . 'config/');
define('MODELS_PATH', APP_ROOT . 'app/models/');

// For debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once(CONFIG_PATH . 'include.php');

$path = array_key_exists('path', $_GET) ? $_GET['path'] : array_key_exists('path', $_POST) ? : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$request = array_merge($_POST, $_GET);

	require_once(CONFIG_PATH . 'routes.php');
} else {
	$request = $_GET;
	require_once(VIEW_PATH . 'layout.php');
}
