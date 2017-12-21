<?php
class Ingredient extends Model {
	public static $fillable = ['id', 'name', 'nicename', 'nicename_plural', 'created_at', 'updated_at'];
	protected static $table = 'ingredient';
}