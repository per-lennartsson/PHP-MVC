<?php

require __DIR__.'/config_with_app.php';

$di  = new \Anax\DI\CDIFactoryDefault();


$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
    $db->connect();
    return $db;
});

$di->set('QuestionController', function() use ($di) {
    $controller = new Anax\Question\QuestionController();
    $controller->setDI($di);
    return $controller;
});

$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});

$di->set('TagController', function() use ($di) {
    $controller = new Anax\Tag\TagController();
    $controller->setDI($di);
    return $controller;
});

$di->set('AuthenticateController', function() use ($di) {
    $controller = new Anax\Authenticate\AuthenticateController();
    $controller->setDI($di);
    return $controller;
});

$di->setShared('Authenticate', function() use ($di) {
    $authenticated = new Anax\Authenticate\Authenticate();
    $authenticated->setDI($di);
    return $authenticated;
});

$di->set('CommentController', function() use ($di) {
    $controller = new Anax\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});
/*
$di->setShared('flash', function() {
    $flash = new \Anax\CFlashMessage\CFlashMessage();
    return $flash;
});
*/
$di->set('form', '\Mos\HTMLForm\CForm');

$app = new \Anax\Kernel\CAnax($di);
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

$app->router->add('',function() use($app){

    $app->theme->setTitle("Start");
    $app->dispatcher->forward([
        'controller' => 'tag',
        'action'     => 'index',
        'params'     => [5,"DESC"],
    ]);

    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'view',
        'params'     => [5,"DESC"],
    ]);

    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'index',
        'params'     => [5,"DESC"],
    ]);


});

// Kommentarer
$app->router->add('question', function() use ($app) {


    $app->theme->setTitle("Frågor");
    $app->dispatcher->forward([
        'controller' => 'question',
        'action'     => 'view',
    ]);


});

$app->router->add('users', function() use ($app) {

    $app->theme->setTitle("Users");
    $app->dispatcher->forward([
        'controller' => 'users',
        'action'     => 'index',
    ]);

});


$app->router->add('tag', function() use ($app) {

    $app->dispatcher->forward([
        'controller' => 'tag',
        'action'     => 'view',
    ]);

});

$app->router->add('authenticate', function() use ($app) {

    $app->theme->setTitle("Login");

    $app->dispatcher->forward([
        'controller' => 'authenticate',
        'action'     => 'login',
    ]);

});

$app->router->add('about', function() use ($app) {

    $app->theme->setTitle("Om");

    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, "shortcode, markdown");

    $app->views->add('me/page', [
       'content' => $content,
   ]);

});

$app->router->add('redovisning', function() use ($app) {
    $app->theme->setTitle("Redovisning");
    $content = $app->fileContent->get('redovisning.md');
    $content = $app->textFilter->doFilter($content,"shortcode, markdown");
    $app->views->add('me/page', [
        'content' => $content,
    ]);

});


    $app->router->handle();
    $app->theme->render();
