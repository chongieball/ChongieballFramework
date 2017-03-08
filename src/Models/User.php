<?php 

namespace Chongieball\Models;

class User extends BaseModel
{
	protected $table = 'user';

	public function login($username, $password)
	{
		$find = $this->find('username', $username);

		if (!empty($find)) {
			if (password_verify($password, $find['password'])) {
				return true;
			} else {
				return 'password salah';
			}
		} else {
			return 'username salah';
		}
	}

}