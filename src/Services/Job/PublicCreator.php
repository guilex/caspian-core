<?php namespace Gil\Caspian\Services\Job;

use Gil\Caspian\Job;
use Gil\Caspian\Services\Job\Creator;
use Gil\Caspian\Common\AbstractService;
use Gil\Caspian\Mailers\JobInModeration;

class PublicCreator extends AbstractService {

	protected $modarator;

	protected $mailer;

	// protected $creator;

	public function __construct(Moderator $moderator, JobInModeration $mailer)
	{
		$this->moderator = $moderator;
		$this->mailer = $mailer;
	}

	// public function create($data)
	// {
	// 	return $this->creator->notify($this)->create($data);
	// }

	public function succes($job)
	{
		if ($job instanceof Job)
		{
			$this->moderator->moderate(&$job);

			if ($job->status === Job::STATUS_MODERATION)
			{
				$this->mailer->send($job);
			}
		}

		return $this->notifyListener()->success($job);
	}

	public function failure($message)
	{
		return $this->notifyListener()->failure($message);
	}

	public function validationFailure($messages)
	{
		return $this->notifyListener()->validationFailure($messages);
	}
}