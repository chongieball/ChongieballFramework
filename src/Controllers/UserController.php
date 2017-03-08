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

	public function getSignUp(Request $request, Response $response)
	{
		return $this->view->render($response, 'user/signup.twig');
	}

	public function postSignUp(Request $request, Response $response)
	{
		
		$this->validator->rule('required', ['username', 'name', 'email', 'password'])->message('{field} Must Not Empty');
		$this->validator->rule('email', ['email'])->message('Invalid Email Address');

		//setting label
		$this->validator->labels([
			'username'	=> 'Username',
			'name'		=> 'Name',
			'email'		=> 'Email',
			'password'	=> 'Password',
			]);

		//validate 
		if ($this->validator->validate()) {
			$user = new \Chongieball\Models\User($this->db);

			$user->add($request->getParams());

			$this->flash->addMessage('success', 'Sign Up Success');

		} else {
			$_SESSION['errors'] = $this->validator->errors();

			//when get error return old input
			$_SESSION['old'] = $request->getParams();

			return $response->withRedirect($this->router->pathFor('user.signup'));

		}
		
		return $response->withRedirect($this->router->pathFor('user.index'));
	}
}