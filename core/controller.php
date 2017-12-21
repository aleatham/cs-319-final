<?php
// Base class for all controllers to extend
class Controller {
	protected function show($view, $args = null) {
		if (is_array($args))
			extract($args);

		require_once(VIEW_PATH . $view . '.php');
	}

	protected function redirect($path, $query = null) {
		if ($query) {
			$path .= '&' . http_build_query($query);
		}
		header('Location: index.php?path=' . $path);
	}
}