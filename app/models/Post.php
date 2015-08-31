<?php
class Post extends Eloquent
{
	protected $guarded = array("*");

	protected $fillable = array("user_id", "title", "body");

	public function user()
	{
		return $this->belongsTo("User");
	}

	public function comments()
	{
		return $this->hasMany("Comment");
	}
}