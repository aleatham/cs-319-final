<?php
class RecipeType extends Model {
	public static $fillable = ['id', 'name', 'description', 'nicename', 'nicename_plural', 'created_at', 'updated_at'];
	protected static $table = 'recipe_type';
}