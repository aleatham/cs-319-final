<div class="jumbotron">
	<h1><?= $list->name ?></h1>
	<small>created on <?= $list->created_at ?></small>
	<?php echo $list->updated_at ? '<small>last updated on ' . $list->updated_at . '</small>' : ''; ?>
	<div class="pull-right">
		<?php require_once(VIEW_PATH . 'lists/modal.php'); ?>
	</div>
</div>

<h5>Ingredients</h5>
<ul class="list">
	<?php foreach ($recipe_ingredients as $ingredient): ?>
	  <li>
	  	<?= $ingredient['nicename'] ?>
	  </li>
	<?php endforeach; ?>
</ul>

