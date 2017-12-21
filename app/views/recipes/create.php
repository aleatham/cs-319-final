<div class="container-fluid login-form">
  <div class="row">
    <div class="col-md-12 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading login-h4"><h4>Create a new recipe!</h4></div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="?path=post_recipe" id="form">
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
              <label for="recipe_type_id" class="col-md-4 control-label">Recipe Type</label>
              <div class="col-md-6">
                <select name="recipe_type_id" class="form-control" id="recipe_type_id">
                  <option value="-1">Select a recipe type</option>
                  <?php foreach ($recipe_types as $type): ?>
                    <option value="<?= $type->id ?>"><?= $type->nicename ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php if ($errors && array_key_exists('recipe_type_id', $errors)): ?>
                <div class="alert alert-danger">
                  <strong><?= $errors['recipe_type_id'] ?></strong>
                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <label for="description" class="col-md-4 control-label">Description</label>

              <div class="col-md-6">
                <textarea id="description" class="form-control" name="description" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-outline-primary"> 
                    Create Recipe
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>