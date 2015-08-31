<?php
class Comment extends Eloquent
{
	protected $guarded = array("*");

	protected $fillable = array("user_id", "post_id", "comment");

	public function user()
	{
		return $this->belongsTo("User");
	}

	public function post()
	{
		return $this->belongsTo("Comment");
	}
}