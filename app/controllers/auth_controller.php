<?php
class AuthController extends Controller {
	public function login($request) {
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		$this->show('auth/login', compact('errors'));
	}

	public function register($request) {
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		$this->show('auth/register', compact('errors'));
	}

	public function post_login($request) {
		$user = $this->authenticate($request);
		if ($user) {
			// Set session and login
			$_SESSION['user_id'] = $user->id;
			$this->redirect('');
		} else {
			$errors = [
				'login' => 'Email/Password mismatch.'
			];
			$this->redirect('login', compact('errors'));
		}
	}

	protected function authenticate($request) {
		if (array_key_exists('email', $request) &&
			array_key_exists('pass', $request)) {
			$user = User::find_by(['email' => $request['email']]);
			if ($user && count($user) > 0) {
				$user = $user[0];
			}

			if ($user && $user->pass == $request['pass']) {
				return $user;
			}
		}
		
		return null;
	}

	public function post_register($request) {
		if ($request['pass'] != $request['pass2']) {
			$errors = [
				'pass' => 'Passwords must match.'
			];
			$this->redirect('register', compact('errors'));
		} else {
			$user = new User([
				'first_name' => $request['first_name'],
				'last_name' => $request['last_name'],
				'email' => $request['email'],
				'pass' => $request['pass'],
				// Hard coding in default user_type of 'user' for now
				//TODO: in user_type model make a default user_type
				'user_type_id' => 1
			]);
			$user->save();

			$this->redirect('login');
		}
	}

	public function password() {
		$this->show('auth/password');
	}

	public function logout() {
		session_destroy();
		$this->redirect('login');
	}
}
