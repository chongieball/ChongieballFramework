<?php 

namespace Chongieball\Models;

class User extends BaseModel
{
	protected $table = 'user';

	public function add(array $data)
	{
		$data = [
			'username'	=> $data['username'],
			'name'		=> $data['name'],
			'email'		=> $data['email'],
			'password'	=> password_hash($data['password'], PASSWORD_DEFAULT),
			];

		$this->create($data);
	}

}