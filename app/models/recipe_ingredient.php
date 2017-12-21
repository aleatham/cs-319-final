<?php
require_once(MODELS_PATH . 'list.php');
require_once(MODELS_PATH . 'recipe_list.php');

class RecipeIngredient extends Model {
	public static $fillable = ['id', 'qty', 'ingredient_id', 'recipe_id', 'created_at', 'updated_at'];
	protected static $table = 'recipe_ingredient';
	public static $ingredients = NULL;

	protected function init() {
		static::setup_ingredients();
	}

	protected static function setup_ingredients() {
		if (!isset(self::$ingredients)) {
			self::$ingredients = [];
			$db_ingredients = Ingredient::all();
			foreach ($db_ingredients as $ingredient) {
				self::$ingredients[$ingredient->id] = [
					'name' => $ingredient->name,
					'nicename' => $ingredient->nicename,
					'nicename_plural' => $ingredient->nicename_plural
				];
			}
		}
	}

	public static function find_for_list($id) {
		static::setup_ingredients();
		$recipe_lists = RecipeList::find_by(['list_id' => $id]);
		$ingredients = [];
		foreach ($recipe_lists as $recipe_list) {
			$recipe_ingredients = RecipeIngredient::find_by(
				['recipe_id' => $recipe_list->recipe_id]
			);
			if (is_array($recipe_ingredients)) {
				foreach ($recipe_ingredients as $recipe_ingredient) {
					if (!array_key_exists($recipe_ingredient->ingredient_id, $ingredients)) {
						$ingredient = static::$ingredients[$recipe_ingredient->ingredient_id];
						$ingredients[$recipe_ingredient->ingredient_id] = $ingredient;
					}
				}
			}
		}
		return $ingredients;
	}

	public function __get($strName) {
		if (array_key_exists($strName, $this->properties)) {
			return $this->properties[$strName];
		} else {
			$ingredient = static::$ingredients[$this->ingredient_id];
			if (array_key_exists($strName, $ingredient)) {
				return $ingredient[$strName];
			}
		}
	}
}