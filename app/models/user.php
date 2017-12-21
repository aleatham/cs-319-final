<?php
class User extends Model {
	public static $fillable = ['id', 'first_name', 'last_name', 'email', 'pass', 'user_type_id', 'created_at', 'updated_at'];
	protected static $table = 'user';
	public $is_admin = false;

	protected function init() {
		// this caches the response from db so we dont have to keep making calls
		//TODO: add user_type model and check if name == 'admin'
		if ($this->user_type_id && $this->user_type_id == 2)
			$this->is_admin = true;
	}

	protected function cascade() {
		// cascade ratings
		$ratings = Rating::find_by(['user_id' => $this->id]);

		if (is_array($ratings)) {
			foreach ($ratings as $rating) {
				$rating->destroy();
			}
		}

		// cascade lists
		$lists = GMF_List::find_by(['user_id' => $this->id]);

		if (is_array($lists)) {
			foreach ($lists as $list) {
				$list->destroy();
			}
		}

		// cascade comments
		$comments = Comment::find_by(['user_id' => $this->id]);

		if (is_array($comments)) {
			foreach ($comments as $comment) {
				$comment->destroy();
			}
		}


		// cascade recipes
		$recipes = Recipe::find_by(['user_id' => $this->id]);

		if (is_array($recipes)) {
			foreach ($recipes as $recipe) {
				$recipe->destroy();
			}
		}
		
	}
}