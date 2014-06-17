<?php namespace Gil\Caspian;

class Job {

	const STATUS_MODERATION;
	const STATUS_PUBLISHED;

	public $title;
	public $description;


	public function __construct($title, $description)
	{
		$this->title = $title;
		$this->description = $description;
	}


	public function newInstance($title, $description)
	{
		return new static($title, $description);
	}

}