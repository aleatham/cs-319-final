<?php
class Recipe extends Model {
	public static $fillable = ['id', 'user_id', 'name', 'average_rating', 'description', 'recipe_type_id', 'created_at', 'updated_at'];
	protected static $table = 'recipe';

	protected function cascade() {
		// cascade ratings
		$ratings = Rating::find_by(['recipe_id' => $this->id]);

		if (is_array($ratings)) {
			foreach ($ratings as $rating) {
				$rating->destroy();
			}
		}

		// cascade recipe_list
		$recipe_lists = RecipeList::find_by(['recipe_id' => $this->id]);

		if (is_array($recipe_lists)) {
			foreach ($recipe_lists as $recipe_list) {
				$recipe_list->destroy();
			}
		}
		

		// cascade comments
		$comments = Comment::find_by(['recipe_id' => $this->id]);

		if (is_array($comments)) {
			foreach ($comments as $comment) {
				$comment->destroy();
			}
		}
		

		// cascade recipe_ingredients
		$recipe_ingredients = RecipeIngredient::find_by(
			['recipe_id' => $this->id]
		);

		if (is_array($recipe_ingredients)) {
			foreach ($recipe_ingredients as $recipe_ingredient) {
				$recipe_ingredient->destroy();
			}
		}
	}

	public function calculate_average_rating() {
		$ratings = Rating::find_by(['recipe_id' => $this->id]);
		if (!is_array($ratings) || count($ratings) <= 0)
			return;

		$sum = 0;
		foreach ($ratings as $rating) {
			$sum += $rating->rating;
		}

		$this->average_rating = $sum / count($ratings);
	}
}
