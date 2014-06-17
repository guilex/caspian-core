<?php namespace Gil\Caspian\Common;

abstract class AbstractService {

	protected $listener;

	public function notify($listener)
	{
		$this->listener = $listener;
	}

	public function notifyListener()
	{
		if ($listener instanceof ListenerInterface)
		{
			return $this->listener;
		}

		throw new ListenerNotSetException();
	}

}