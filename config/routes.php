<?php 
$title = 'Get My Fixings';
// Define the routes here
switch ($path) {
	case '': // Root
		$controller = 'application';
		$action = 'home';
		break;
	case 'recipes':
		$title = 'Recipes';
		$controller = 'recipe';
		$action = 'index';
		break;
	case 'recipes/create':
		$title = 'Create Recipe';
		$controller = 'recipe';
		$action = 'create';
		break;
	case 'recipes/delete':
		$controller = 'recipe';
		$action = 'delete';
		break;
	case 'recipes/search':
		$controller = 'recipe';
		$action = 'search';
		break;
	case 'post_recipe':
		$controller = 'recipe';
		$action = 'post_recipe';
		break;
	case 'post_ingredient':
		$controller = 'recipe';
		$action = 'post_ingredient';
		break;
	case 'post_comment':
		$controller = 'comment';
		$action = 'post_comment';
		break;
	case 'comments/delete':
		$controller = 'comment';
		$action = 'delete';
		break;
	case 'post_rating':
		$controller = 'recipe';
		$action = 'post_rating';
		break;
	case 'lists':
		$title = 'Lists';
		$controller = 'list';
		$action = 'index';
		break;
	case 'lists/create':
		$title = 'Lists';
		$controller = 'list';
		$action = 'create';
		break;
	case 'lists/delete':
		$title = 'Lists';
		$controller = 'list';
		$action = 'delete';
		break;
	case 'post_list':
		$title = 'Lists';
		$controller = 'list';
		$action = 'post_list';
		break;
	case 'refresh_list':
		$title = 'Lists';
		$controller = 'list';
		$action = 'refresh_list';
		break;
	case 'login':
		$title = 'Login';
		$controller = 'auth';
		$action = 'login';
		break;
	case 'post_login':
		$controller = 'auth';
		$action = 'post_login';
		break;
	case 'logout':
		$controller = 'auth';
		$action = 'logout';
		break;
	case 'register':
		$title = 'Register';
		$controller = 'auth';
		$action = 'register';
		break;
	case 'post_register':
		$controller = 'auth';
		$action = 'post_register';
		break;
	case 'password':
		$title = 'Change Password';
		$controller = 'auth';
		$action = 'password';
		break;
	case 'users':
		$title = 'Users';
		$controller = 'user';
		$action = 'index';
		break;
	case 'users/delete':
		$controller = 'user';
		$action = 'delete';
		break;
	default: // Not Found
		$controller = 'application';
		$action = 'not_found_error';
}

require_once(MODELS_PATH . 'user.php');
global $current_user;
if (array_key_exists('user_id', $_SESSION) && ($user_id = $_SESSION['user_id']) && $user_id > 0) {
	$current_user = User::find($user_id);
} else
	$current_user = new User(['id' => 0]);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	require_once(VIEW_PATH . 'partials/head.php');
	require_once(VIEW_PATH . 'partials/header.php');
	echo '<div id="main" class="container-fluid"> <!-- #main -->';
}

// Allowed controllers/actions
$controllers = [
	'application' => ['home', 'not_found_error'],
	'auth' => ['login', 'register', 'post_login', 'post_register', 'password', 'logout'],
	'list' => ['index', 'create', 'delete', 'post_list', 'refresh_list'],
	'recipe' => ['index', 'create', 'post_recipe', 'delete', 'post_ingredient', 'post_rating', 'search'],
	'user' => ['index', 'delete'],
	'comment' => ['post_comment', 'delete']
];


// If controller/action are not allowed redirect
// to appropriate error
if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action, $request);
	} else {
		call('application', 'not_found_error', $request);
	}
} else {
	call('application', 'internal_service_error', $request);
}

// Convert the controller to the controller class
// and call the appropriate action
function call($controller, $action, $request) {
	require_once(CONTROLLER_PATH . $controller . '_controller.php');

	$className = str_replace(' ', '', ucwords(str_replace('_', ' ', $controller))) . 'Controller';
	$objController = new $className();
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$objController-> { $action }($request);
	} else {
		$objController-> { $action }($request);
	}
}
