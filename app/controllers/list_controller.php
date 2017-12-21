<?php
require_once(MODELS_PATH . 'list.php');
require_once(MODELS_PATH . 'recipe.php');
require_once(MODELS_PATH . 'recipe_list.php');
require_once(MODELS_PATH . 'recipe_ingredient.php');
require_once(MODELS_PATH . 'ingredient.php');


class ListController extends Controller {
	public function index($request) {
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;

		// SINGLE
		if (array_key_exists('id', $request) &&
			is_numeric($request['id']) &&
			$request['id'] > 0) {
			$this->single($request, $errors);
		// INDEX
		} else {
			global $current_user;
			$lists = GMF_List::find_by(['user_id' => $current_user->id]);
			$this->show('lists/index', compact('lists', 'errors', 'current_user'));
		}
	}

	protected function single($request, $errors) {
		$list = GMF_List::find($request['id']);
		$recipes = Recipe::all();
		$associated_recipe_ids = [];
		$recipe_lists = RecipeList::find_by(['list_id' => $list->id]);

		foreach ($recipe_lists as $recipe_list) {
			$associated_recipe_ids[] = $recipe_list->recipe_id;
		}

		$recipe_ingredients = RecipeIngredient::find_for_list($list->id);
		$this->show('lists/single', compact('list', 'ingredients', 'recipe_ingredients', 'recipes', 'associated_recipe_ids'));
	}

	public function create($request) {
		$recipes = Recipe::all();
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		$this->show('lists/create', compact('errors', 'recipes'));
	}

	public function delete($request) {
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error deleting list.'
			];
			$this->redirect('lists', compact('errors'));
		}
		$list = GMF_List::find($request['id']);

		$result = $list->destroy();

		if ($result) {
			$this->redirect('lists');
		} else {
			$errors = [
				'error' => 'Error deleting list.'
			];
			$this->redirect('lists');
		}
	}

	public function post_list($request) {
		global $current_user;
		if (!array_key_exists('recipe_ids', $request) ||
			count($request['recipe_ids']) <= 0) {
			$errors = [
				'recipe_ids' => 'Please select at least one recipe.'
			];
			$this->redirect('lists/create', compact('errors'));
		} 
		if (strlen($request['name']) <= 0) {
			$errors = [
				'name' => 'Please enter a list name.'
			];
			$this->redirect('lists/create', compact('errors'));
		}

		if (!isset($errors)) {
			$list = new GMF_List([
				'name' => $request['name'],
				'user_id' => $current_user->id
			]);
			$list->save();

			foreach ($request['recipe_ids'] as $recipe_id) {
				$recipe_list = new RecipeList([
					'recipe_id' => $recipe_id,
					'list_id' => $list->id,
				]);
				$recipe_list->save();
			}

			$this->redirect('lists', ['id' => $list->id]);
		}
	}

	public function refresh_list($request) {
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error refreshing list.'
			];
			$this->redirect('lists', compact('errors'));
		}
		if (!array_key_exists('recipe_ids', $request) ||
			count($request['recipe_ids']) <= 0) {
			$errors = [
				'recipe_ids' => 'Please select at least one recipe.'
			];
			$id = $request['id'];
			$this->redirect('lists', compact('errors', 'id'));
		}

		if (!isset($errors)) {
			$recipe_lists = RecipeList::find_by(
				['list_id' => $request['id']]
			);

			foreach ($recipe_lists as $recipe_list) {
				$recipe_list->destroy();
			}

			foreach ($request['recipe_ids'] as $recipe_id) {
				$recipe_list = new RecipeList([
					'recipe_id' => $recipe_id,
					'list_id' => $request['id'],
				]);
				$recipe_list->save();
			}

			$this->redirect('lists', ['id' => $request['id']]);
		}
	}
}
