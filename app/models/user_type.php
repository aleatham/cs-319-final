<?php
class UserType extends Model {
	public static $fillable = ['id', 'name', 'description', 'nicename', 'nicename_plural', 'created_at', 'updated_at'];
	protected static $table = 'user_type';
}
