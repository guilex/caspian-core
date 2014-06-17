<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Job;
use Gil\Caspian\Common\AbstractService;
use Gil\Caspian\Sanitizer\JobSanitizer;
use Gil\Caspian\Validators\JobValidator;
use Gil\Caspian\Contracts\Repositories\JobInterface;

class Creator extends AbstractService {

	protected $model;
	protected $repository;
	protected $validator;
	protected $sanitizer;

	public function __construct(
		Job $model,
		JobInterface $repository, 
		JobValidator $validator,
		JobSanitizer $sanitizer
	)
	{
		$this->model = $model;
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
			$job = $this->model->newInstance($sanitized['title'], $sanitized['description']);
			
			if ($this->repository->create($job))
			{
				return $this->notifyListener()->success($job);
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