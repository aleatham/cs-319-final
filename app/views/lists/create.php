<div class="container-fluid login-form">
  <div class="row">
    <div class="col-md-12 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading login-h4"><h4>Create a new list!</h4></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="?path=post_list" id="form">
            <div class="form-group">
              <label for="name" class="col-md-4 control-label">Name</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
              </div>
              <?php if ($errors && array_key_exists('name', $errors)): ?>
                <div class="alert alert-danger">
                  <strong><?= $errors['name'] ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <!-- recipe_type dropdown -->
            <div class="form-group">
              <label for="recipe_ids" class="col-md-4 control-label">
                Recipes
              </label>
              <div class="col-md-6">
                <select multiple="" name="recipe_ids[]" class="form-control" id="recipe_ids">
                  <?php foreach ($recipes as $recipe): ?>
                    <option value="<?= $recipe->id ?>"><?= $recipe->name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php if ($errors && array_key_exists('recipe_ids', $errors)): ?>
                <div class="alert alert-danger">
                  <strong><?= $errors['recipe_ids'] ?></strong>
                </div>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-outline-primary"> 
                    Generate List
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>