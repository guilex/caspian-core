<?php

// PSEUDO

class JobController {
	
	$baseCreator;
	$publicCreator;

	public function __construct(Creator $baseCreator, PublicCreator $publicCreator)
	{
		$this->baseCreator = $baseCreator;
		$this->publicCreator = $publicCreator;
	}

	// public user create
	public function create()
	{
		return $this
			->creator
			->notify($publicCreator->notify($this))
			->create($inputData);
	}


	public function success($job)
	{
		return $this->apiResponse(new JobViewModel($job));
	}

}