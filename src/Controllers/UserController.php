<?php 

namespace Chongieball\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Chongieball\Models\User;

class UserController extends BaseController
{

	public function index(Request $request, Response $response)
	{
		$users = new User($this->db);

		$showAll = $users->getAll();

		$data['show'] = $showAll;

		return $this->view->render($response, 'user/index.twig', $data);
	}

	public function showByUsername(Request $request, Response $response, $args)
	{
		$user = new User($this->db);

		$getUser = $user->find('username', $args['username']);

		$data['profile'] = $getUser;
		
		if (!empty($getUser)) {
			return $this->view->render($response, 'user/profile.twig', $data);
		} else {
			return $this->view->render($response, 'user/error.twig');
		}
		
	}
}