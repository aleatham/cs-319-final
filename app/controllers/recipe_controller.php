<?php
require_once(MODELS_PATH . 'recipe.php');
require_once(MODELS_PATH . 'comment.php');
require_once(MODELS_PATH . 'recipe_type.php');
require_once(MODELS_PATH . 'ingredient.php');
require_once(MODELS_PATH . 'recipe_ingredient.php');
require_once(MODELS_PATH . 'rating.php');

class RecipeController extends Controller {
	public function index($request) {
		global $current_user;
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		
		// SINGLE
		if (array_key_exists('id', $request) &&
			is_numeric($request['id']) &&
			$request['id'] > 0) {
			$this->single($request, $errors);
		// INDEX
		} else {
			if (array_key_exists('search', $request) &&
				strlen($request['search']) > 0 &&
				is_numeric($request['search'])) {
				$recipes = Recipe::find_by(['recipe_type_id' => $request['search']]);
			} else {
				$recipes = Recipe::all();
			}
			$recipe_types = RecipeType::all();
			$this->show('recipes/index', compact('recipes', 'errors', 'current_user', 'recipe_types'));
		}
	}

	public function search($request) {
		if (!array_key_exists('search', $request)) {
			$errors = [
				'error' => 'Error searching for recipes.'
			];
			$this->redirect('recipes', compact('errors'));
		}

		$search = $request['search'];

		$this->redirect('recipes', compact('search'));
	}

	protected function single($request, $errors) {
		global $current_user;
		$recipe = Recipe::find($request['id']);
		$recipe_type = RecipeType::find($recipe->recipe_type_id);
		$recipe_ingredients = RecipeIngredient::find_by(['recipe_id' => $recipe->id]);
		if (!RecipeIngredient::$ingredients) {
			new RecipeIngredient([]);
		}
		$rating = Rating::find_by([
			'user_id' => $current_user->id,
			'recipe_id' => $request['id']
		]);
		if (count($rating) > 0) {
			$rating = $rating[0];
		}
		$owner = User::find($recipe->user_id);
		$ingredients = RecipeIngredient::$ingredients;
		$comments = Comment::find_by(['recipe_id' => $recipe->id]);
		$this->show('recipes/single', compact('recipe', 'comments', 'ingredients', 'recipe_ingredients', 'owner', 'current_user', 'rating', 'recipe_type'));
	}

	public function create($request) {
		$recipe_types = RecipeType::all();
		$errors = array_key_exists('errors', $request) ? $request['errors'] : null;
		$this->show('recipes/create', compact('errors', 'recipe_types'));
	}

	public function post_recipe($request) {
		global $current_user;
		if ($request['recipe_type_id'] == -1) {
			$errors = [
				'recipe_type_id' => 'Please select a recipe type.'
			];
			$this->redirect('recipes/create', compact('errors'));
		} 
		if (strlen($request['name']) <= 0) {
			$errors = [
				'name' => 'Please enter a recipe name.'
			];
			$this->redirect('recipes/create', compact('errors'));
		}

		if (count($errors) == 0) {
			$recipe = new Recipe([
				'recipe_type_id' => $request['recipe_type_id'],
				'name' => $request['name'],
				'description' => $request['description'],
				'user_id' => $current_user->id
			]);
			$recipe->save();
			$this->redirect('recipes', ['id' => $recipe->id]);
		}
	}

	public function delete($request) {
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error deleting recipe.'
			];
			$this->redirect('recipes', compact('errors'));
		}
		global $current_user;

		$recipe = Recipe::find($request['id']);

		if ($current_user->id == 0 || $recipe->user_id != $current_user->id) {
			$errors = [
				'error' => 'You cannot delete that recipe.'
			];
			$this->redirect('recipes', compact('errors'));
		}

		$result = $recipe->destroy();

		if ($result) {
			$this->redirect('recipes');
		} else {
			$errors = [
				'error' => 'Error deleting recipe.'
			];
			$this->redirect('recipes', compact('errors'));
		}
	}

	public function post_ingredient($request) {
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error adding ingredient.'
			];
			$this->redirect('recipes', compact('errors'));
		}
		if (!array_key_exists('ingredient_id', $request) ||
			$request['ingredient_id'] <= 0) {
			$errors = [
				'error' => 'Error adding ingredient.'
			];
			$id = $request['id'];
			$this->redirect('recipes', compact('id', 'errors'));
		}

		$recipe_ingredient = new RecipeIngredient([
			'recipe_id' => $request['id'],
			'ingredient_id' => $request['ingredient_id']
		]);

		if (array_key_exists('qty', $request)) {
			$recipe_ingredient->qty = $request['qty'];
		}

		$recipe_ingredient->save();
		$this->redirect('recipes', ['id' => $request['id']]);
	}

	public function post_rating($request) {
		if (!array_key_exists('id', $request)) {
			return false;
		}
		global $current_user;
		$id = $request['id'];
		if ($current_user->id <= 0) {
			return false;
		}
		$rating = Rating::find_by([
			'user_id' => $current_user->id,
			'recipe_id' => $id
		]);
		if (count($rating) > 0) {
			$rating = $rating[0];
			$rating->destroy();
		}
		if (!array_key_exists('rating', $request)) {
			return false;
		}

		$rating = new Rating([
			'user_id' => $current_user->id,
			'recipe_id' => $id,
			'rating' => $request['rating']
		]);
		$rating->save();
		return true;
	}
}
