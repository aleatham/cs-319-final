<?php
require_once(MODELS_PATH . 'recipe_list.php');

class GMF_List extends Model {
	public static $fillable = ['id', 'name', 'user_id', 'created_at', 'updated_at'];
	protected static $table = 'list';

	protected function cascade() {
		// cascade recipe_lists
		$recipe_lists = RecipeList::find_by(['list_id' => $this->id]);

		if (!is_array($recipe_lists) || count($recipe_lists) <= 0) {
			return;
		}
		
		foreach ($recipe_lists as $recipe_list) {
			$recipe_list->destroy();
		}
	}
}