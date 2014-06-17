<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Sanitizer\JobSanitizer;
use Gil\Caspian\Validators\JobValidator;
use Gil\Caspian\Contracts\Repositories\JobInterface;

class ListRetriever {

	protected $repository;

	public function __construct(JobInterface $repository)
	{
		$this->repository = $repository;
	}

	public function retrieve($id, $limit, $offset)
	{
		$job = $this->repository->getAllPublished($id, $limit, $offset);

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