<?php

require __DIR__.'/config_with_app.php';

$di->setShared('flash', function() {
    $flash = new \Anax\CFlashMessage\CFlashMessage();
    return $flash;
});

$app->session;

$app->theme->addStylesheet('css/flash.css');

$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Flash test");

    $app->session;

    $app->flash->message('info', 'This is a info message');
    $app->flash->message('error', 'This is a error message');
    $app->flash->message('success', 'This is a success message');
    $app->flash->message('warning', 'This is a warning message');


    $app->theme->setVariable('title', "Flash test")
           ->setVariable('main', $app->flash->getMessages());

});

$app->router->handle();
$app->theme->render();
