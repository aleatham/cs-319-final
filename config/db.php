<?php
class Db {
	private static $instance = NULL;
	private function __construct() {}
	private function __clone() {}

	public static function getInstance() {
		if (!isset(self::$instance)) {
			require_once('../../mysqli_connect.php');
			self::$instance = $dbc;
		}
		return self::$instance;
	}
}