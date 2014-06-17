<?php namespace Gil\Caspian\Contracts\Repositories;

interface BaseInterface {

	public function getOne($id);

	public function getAll();

	public function create($data);

	public function update($id, $data);

	public function delete($id, $soft);
}