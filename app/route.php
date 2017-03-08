<?php 

$app->get('/', 'Chongieball\Controllers\HomeController:index')->setName('home');

$app->get('/users', 'Chongieball\Controllers\UserController:index')->setName('user.index');

$app->get('/signup', 'Chongieball\Controllers\UserController:getSignUp')->setName('user.signup');
$app->post('/signup', 'Chongieball\Controllers\UserController:postSignUp');

$app->get('/{username}', 'Chongieball\Controllers\UserController:showByUsername')->setName('user.find');