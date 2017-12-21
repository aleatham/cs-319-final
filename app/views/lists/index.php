<?php if ($errors && array_key_exists('error', $errors)): ?>
	<div class="alert alert-danger">
	  <strong><?= $errors['error'] ?></strong>
	</div>
	<?php endif; ?>
<h2>Lists</h2>
<?php if ($current_user->id > 0): ?>
	<p>
		<a href="index.php?path=lists/create" class="btn btn-outline-primary"> 
		    Generate List
		</a>
	</p>
<?php endif; ?>

<table class="table">
	<thead>
		<th>Name</th>
		<th>Link</th>
		<th>Created At</th>
		<th>Action</th>
	</thead>
	<?php foreach ($lists as $list): ?>
		<tr>
			<td><?= $list->name ?></td>
			<td>
				<a href="index.php?path=lists&id=<?= $list->id ?>">View list</a>
			</td>
			<td><?= $list->created_at ?></td>
			<td>
				<form action="index.php?path=lists/delete&id=<?= $list->id ?>" method="POST">
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
