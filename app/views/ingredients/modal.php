<?php if ($current_user->id > 0 && $current_user->id == $recipe->user_id): ?>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ingredientModal">
    Add Ingredient
  </button>
<?php endif; ?>

<form action="index.php?path=post_ingredient&id=<?= $recipe->id ?>" method="POST">
  <div class="modal fade" id="ingredientModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Ingredient</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="ingredient_id" class="col-md-4 control-label">Ingredient</label>

              <div class="col-md-6">
                 <select name="ingredient_id" class="form-control" id="ingredient_id">
                    <option value="-1">Select an ingredient</option>
                    <?php foreach ($ingredients as $id => $ingredient): ?>
                      <option value="<?= $id ?>"><?= $ingredient['nicename'] ?></option>
                    <?php endforeach; ?>
                  </select>
              </div>
            </div>
            <div class="form-group">
              <label for="ingredient_id" class="col-md-4 control-label">Quantity</label>
              <div class="col-md-6">
                <input type="number" name="qty" id="qty" />
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>