<?php if (is_array($recipe_ingredients)): ?>
	<h4>Ingredients:</h4>
	<ul>
		<?php foreach ($recipe_ingredients as $ingredient): ?>
		  <li>
		  	<?= $ingredient->nicename ?>
		  </li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
