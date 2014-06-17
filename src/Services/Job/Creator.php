<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Common\AbstractService;
use Gil\Caspian\Sanitizer\JobSanitizer;
use Gil\Caspian\Validators\JobValidator;
use Gil\Caspian\Contracts\Repositories\JobInterface;

class Creator extends AbstractService {

	protected $repository;
	protected $validator;
	protected $sanitizer;

	protected $listener;

	public function __construct(
		JobInterface $repository, 
		JobValidator $validator,
		JobSanitizer $sanitizer
	)
	{
		$this->repository = $repository;
		$this->validator = $validator;
		$this->sanitizer = $sanitizer;
	}

	public function create($data)
	{
		$sanitized = $this->sanitizer->sanitize($data);

		$validaton = $this->validator->forCreate()->validate($sanitized);

		if ($validation->passes())
		{
			if ($this->repository->create($sanitized))
			{
				return $this->notifyListener()->success('job.creation.success');
			}
			else
			{
				return $this->notifyListener()->failure('job.creation.failure');
			}
		}
		else
		{
			return $this->notifyListener()->validationFailure($validation->getErrors());
		}
	}
}