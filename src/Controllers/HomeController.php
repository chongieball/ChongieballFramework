<?php 

namespace Chongieball\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomeController extends BaseController
{

	public function index(Request $request, Response $response)
	{
		$this->flash->addMessage('info', 'Testing Flash Message');
		return $this->view->render($response, 'home.twig');
	}
}