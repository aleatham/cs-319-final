<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#refreshListModal">
  Update List
</button>

<form action="index.php?path=refresh_list&id=<?= $list->id ?>" method="POST">
  <div class="modal fade" id="refreshListModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update List</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="ingredient_id" class="col-md-4 control-label">Recipes</label>

              <div class="col-md-6">
                <select multiple="" name="recipe_ids[]" class="form-control" id="recipe_ids">
                  <?php foreach ($recipes as $recipe): ?>
                    <option <?php echo in_array($recipe->id, $associated_recipe_ids) ? 'selected="selected"' : ''; ?> value="<?= $recipe->id ?>"><?= $recipe->name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Refresh</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>