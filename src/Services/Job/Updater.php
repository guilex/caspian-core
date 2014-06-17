<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Sanitizer\JobSanitizer;
use Gil\Caspian\Validators\JobValidator;
use Gil\Caspian\Contracts\Repositories\JobInterface;

class Updater {

	protected $repository;
	protected $validator;
	protected $sanitizer;

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

	public function update($id, $data)
	{
		$sanitized = $this->sanitizer->sanitize($data);

		$validaton = $this->validator->forCreate()->validate($sanitized);

		if ($validation->passes())
		{
			if ($this->repository->update($id, $sanitized))
			{
				return $this->listener->success('job.update.success');
			}
			else
			{
				return $this->listener->failure('job.update.failure');
			}
		}
		else
		{
			return $this->listener->validationFailure($validation->getErrors());
		}
	}
}