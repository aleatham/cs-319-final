<?php
require_once(MODELS_PATH . 'comment.php');

class CommentController extends Controller {
	public function post_comment($request) {
		global $current_user;

		$comment = new Comment([
			'comment' => $request['comment'],
			'user_id' => $current_user->id,
			'recipe_id' => $request['recipe_id']
		]);

		$comment->save();

		$this->redirect('recipes', ['id' => $comment->recipe_id]);
	}

	public function delete($request) {
		$id = $request['recipe_id'];
		if (!array_key_exists('id', $request)) {
			$errors = [
				'error' => 'Error deleting comment.'
			];
			$this->redirect('recipes', compact('id', 'errors'));
		}
		global $current_user;

		$comment = Comment::find($request['id']);

		if ($current_user->id == 0 || $comment->user_id != $current_user->id) {
			$errors = [
				'error' => 'You cannot delete that comment.'
			];
			$this->redirect('recipes', compact('id', 'errors'));
		}

		$result = $comment->destroy();

		if ($result) {
			$this->redirect('recipes', compact('id'));
		} else {
			$errors = [
				'error' => 'Error deleting comment.'
			];
			$this->redirect('recipes', compact('id', 'errors'));
		}
	}

}
