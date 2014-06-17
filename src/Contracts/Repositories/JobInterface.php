<?php namespace Gil\Caspian\Contracts\Repositories;

interface JobInterface extends BaseInterface {

	public function getOnePublished($id);

	public function getAllPublished($limit, $offset);

}