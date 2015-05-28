<?php
// Get environment & autoloader.
require __DIR__.'/config.php';

// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('form', '\Mos\HTMLForm\CForm');

$app = new \Anax\MVC\CApplicationBasic($di);


$app->router->add('test1', function () use ($app) {
    $app->session();

    $form = $app->form->create([], [
        'name' => [
            'type'        => 'text',
            'label'       => 'Name of contact person:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'phone' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'numeric'],
        ],
        'submit' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
                $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
                $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
                $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
                $form->saveInSession = true;
                return true;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);

    // Check the status of the form
    // Check the status of the form
    $callbackSuccess = function ($form) use ($app) {
        // What to do if the form was submitted?
        $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $app->redirectTo();
    };
    $callbackFail = function ($form) use ($app) {
            // What to do when form could not be processed?
            $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
            $app->redirectTo();
    };
    // Check the status of the form
    $form->check($callbackSuccess, $callbackFail);

    $app->theme->setTitle("Welcome to Anax");
   $app->views->add('default/page', [
       'title' => "Try out a form using CForm",
       'content' => $form->getHTML()
   ]);
});

    $app->router->handle();
    $app->theme->render();
