<?php
class Rating extends Model {
	public static $fillable = ['id', 'rating', 'recipe_id', 'user_id', 'updated_at', 'created_at'];
	protected static $table = 'rating';
}