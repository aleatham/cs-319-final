<?php if (isset($errors) && array_key_exists('error', $errors)): ?>
	<div class="alert alert-danger">
	  <strong><?= $errors['error'] ?></strong>
	</div>
<?php endif; ?>
<h2>Users</h2>
<table class="table">
	<thead>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Type</th>
		<th>Created At</th>
		<th>Action</th>
	</thead>
	<tbody>
<?php foreach ($users as $user): ?>
	<tr>
		<td><?= $user->first_name ?></td>
		<td><?= $user->last_name ?></td>
		<td><?= UserType::find($user->user_type_id)->nicename ?></td>
		<td><?= $user->created_at ?></td>
		<td>
			<?php if ($current_user->is_admin && $current_user->id != $user->id): ?>
			<form action="index.php?path=users/delete&id=<?= $user->id ?>" method="POST">
				<button type="submit" class="btn btn-danger">Delete</button>
			</form>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
</table>
