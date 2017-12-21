<?php if ($errors && array_key_exists('error', $errors)): ?>
	<div class="alert alert-danger">
	  <strong><?= $errors['error'] ?></strong>
	</div>
<?php endif; ?>
<h2>Recipes</h2>
<?php if ($current_user->is_admin): ?>
	<p>
		<a href="index.php?path=recipes/create" class="btn btn-outline-primary"> 
		    Create Recipe
		</a>
	</p>
<?php endif; ?>

<div class="pull-right">
	<form action="index.php?path=recipes/search" method="POST" class="form-inline">
		<select name="search" id="search" class="form-control">
      <option value="-1">Select a recipe type</option>
      <?php foreach ($recipe_types as $type): ?>
        <option value="<?= $type->id ?>"><?= $type->nicename ?></option>
      <?php endforeach; ?>
    </select>
		<button type="submit" class="btn btn-outline-primary"> 
	    <i class="fa fa-search"></i>
		</button>
	</form>
</div>

<table class="table">
	<thead>
		<th>Name</th>
		<th>Rating</th>
		<th>Type</th>
		<th>Link</th>
		<th>Created At</th>
		<th>Action</th>
	</thead>
	<tbody>
<?php foreach ($recipes as $recipe): ?>
	<?php $recipe->calculate_average_rating(); ?>
	<tr>
		<td><?= $recipe->name ?></td>
		<td>
			<?php for ($i = 0; $i < $recipe->average_rating; $i++): ?>
				<i class="fa fa-star text-warning"></i>
			<?php endfor; ?>
		</td>
		<td><?= RecipeType::find($recipe->recipe_type_id)->nicename ?></td>
		<td><a href="index.php?path=recipes&id=<?= $recipe->id ?>">View Recipe</a></td>
		<td><?= $recipe->created_at ?></td>
		<td>
			<?php if ($current_user->id == $recipe->user_id): ?>
			<form action="index.php?path=recipes/delete&id=<?= $recipe->id ?>" method="POST">
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
</table>
