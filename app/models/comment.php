<?php
class Comment extends Model {
	public static $fillable = ['id', 'user_id', 'recipe_id', 'comment', 'created_at', 'updated_at'];
	protected static $table = 'comment';
}