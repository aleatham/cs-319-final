<?php
class RecipeList extends Model {
	public static $fillable = ['id', 'recipe_id', 'list_id', 'created_at', 'updated_at'];
	protected static $table = 'recipe_list';
}