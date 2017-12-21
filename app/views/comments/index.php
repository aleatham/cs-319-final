<h3>Comments <i class="fa fa-caret-down"></i></h3>
<?php if ($current_user->id > 0): ?>
<form class="form-horizontal" role="form" method="POST" action="?path=post_comment&recipe_id=<?= $recipe->id ?>" id="form">
	<div class="form-group">
	  <div class="col-md-6">
	    <textarea id="comment" class="form-control" name="comment" required></textarea>
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-md-8 col-md-offset-4">
	    <button type="submit" class="btn btn-outline-primary"> 
	        Save
	    </button>
	  </div>
	</div>
</form>
<?php endif; ?>

<div class="container">
	<?php if (is_array($comments)): ?>
		<?php foreach ($comments as $comment): ?>
			<div class="row">
				<div>
					<div class="form-inline">
						<strong><?= User::find($comment->user_id)->first_name ?></strong> &nbsp; on <?= $comment->created_at ?> &nbsp;
						<?php if ($current_user->id == $comment->user_id): ?>
							<form action="index.php?path=comments/delete&id=<?= $comment->id ?>&recipe_id=<?=$recipe->id?>" method="POST">
								<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
							</form>
						<?php endif; ?>
					</div>
					<p><?= $comment->comment ?></p>
				</div>
			</div>
			<hr>
		<?php endforeach; ?>
	<?php else: ?>
		<p>There are no comments for this recipe. Be the first!</p>
	<?php endif; ?>
</div>