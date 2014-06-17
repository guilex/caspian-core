<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Sanitizer\JobSanitizer;
use Gil\Caspian\Validators\JobValidator;
use Gil\Caspian\Contracts\Repositories\JobInterface;

class ItemRetriever {

	protected $repository;

	public function __construct(JobInterface $repository)
	{
		$this->repository = $repository;
	}

	public function retrieve($id)
	{
		$job = $this->repository->getOnePublished($id);

		if ($job)
		{
			return $this->listener->success($job);
		}
		else
		{
			return $this->listener->failure('job.retrieval.failure');
		}
	}
}