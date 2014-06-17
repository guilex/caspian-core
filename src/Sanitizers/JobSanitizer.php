<?php namespace Gil\Caspian\Sanitizers;

class JobSanitizer {

	protected $rules = [

		'title' => ['trim', 'strip_tags'],
		'description' => ['trim', 'strip_tags']
	
	]

}