<div class="jumbotron">
	<h1>
		<?= $recipe->name ?>
	</h1>
	<?php if ($current_user->id > 0): ?>
		<div class="pull-right">
			<?php if (!empty($rating) && $rating->rating): ?>
				<div id="stars-existing" class="starrr" data-rating="<?= $rating->rating ?>" data-recipe-id=<?= $recipe->id ?>></div>
			<?php else: ?>
				<div id="stars" class="starrr" data-recipe-id=<?= $recipe->id ?>></div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<small>created by <?= $owner->first_name . ' ' . $owner->last_name ?> on <?= $recipe->created_at ?></small>
	<br />
	<span class="badge badge-pill badge-info"><?= $recipe_type->nicename ?></span>
	<hr />
	<div><?= $recipe->description ?></div>
</div>

<?php require_once(VIEW_PATH . 'ingredients/index.php'); ?>
<?php require_once(VIEW_PATH . 'ingredients/modal.php'); ?>
<?php require_once(VIEW_PATH . 'comments/index.php'); ?>