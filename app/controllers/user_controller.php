<?php
require_once(MODELS_PATH . 'user_type.php');
require_once(MODELS_PATH . 'rating.php');
require_once(MODELS_PATH . 'recipe.php');
require_once(MODELS_PATH . 'comment.php');
require_once(MODELS_PATH . 'list.php');

class UserController extends Controller {
	public function index($request) {
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		global $current_user;
		$users = User::all();
		$this->show('users/index', compact('users', 'current_user', 'errors'));
	}

	public function delete($request) {
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error deleting user.'
			];
			$this->redirect('users', compact('errors'));
		}
		global $current_user;

		if (!$current_user->is_admin &&
			$current_user->id != $request['id']) {
			$errors = [
				'error' => 'You cannot delete that user.'
			];
			$this->redirect('users', comact('errors'));
		}
		$user = User::find($request['id']);

		$result = $user->destroy();

		if ($result) {
			$this->redirect('users');
		} else {
			$errors = [
				'error' => 'Error deleting user.'
			];
			$this->redirect('users', compact('errors'));
		}
	}
}
