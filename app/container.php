<?php 

use Slim\Container;
use Slim\Views\Twig as View;
use Slim\Views\TwigExtension as ViewExt;

$container = $app->getContainer();

$container['db'] = function (Container $container) use ($setting) {
	$setting = $container->get('settings');

	$config = new \Doctrine\DBAL\Configuration();

	$connect = \Doctrine\DBAL\DriverManager::getConnection($setting['db'],
		$config);

	return $connect->createQueryBuilder();
};

$container['view'] = function (Container $container) use ($setting) {
	$setting = $container->get('settings')['view'];

	$view = new View($setting['path'], $setting['twig']);
	$view->addExtension(new ViewExt($container->router, $container->request->getUri()));

	$view->getEnvironment()->addGlobal('flash', $container->flash);
	
	return $view;
};

$container['validator'] = function (Container $container) use ($setting) {
	$setting = $container->get('settings')['lang']['default'];
	$params = $container['request']->getParams();
	
	return new Valitron\Validator($params, [], $setting);
};

$container['flash'] = function (Container $container) {
	return new \Slim\Flash\Messages;
};