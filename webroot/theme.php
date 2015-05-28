<?php
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php';

$app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme.php');

$app->router->add('', function() use ($app) {

  $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
  $app->theme->setTitle("Tema");

    $content = $app->fileContent->get('');
    $header4 = $app->fileContent->get('');
    $sidebar = $app->fileContent->get('');


  $app->views->addString($content, 'main')
               ->addString($sidebar, 'sidebar')
               ->addString($header4, 'featured-1')
             ->addString($header4, 'featured-2')
             ->addString($header4, 'featured-3')
               ->addString($header4, 'triptych-1')
             ->addString($header4, 'triptych-2')
             ->addString($header4, 'triptych-3')
             ->addString($header4, 'footer-col-1')
             ->addString($header4, 'footer-col-2')
             ->addString($header4, 'footer-col-3')
             ->addString($header4, 'footer-col-4');;

});

$app->router->add('regions', function() use ($app) {

    $app->theme->addStylesheet('css/anax-grid/regions_demo.css');
    $app->theme->setTitle("Regioner");

    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');

});

$app->router->add('typography', function() use ($app) {
    $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
    $app->theme->setTitle("Typografi");

    $content = $app->fileContent->get('typography.html');

    $app->views->addString($content, 'main')
               ->addString($content, 'sidebar');

});

$app->router->add('font_awesome', function() use ($app) {
    $app->theme->configure(ANAX_APP_PATH . 'config/theme-grid.php');
    $app->theme->setTitle("Font Awesome");

    $sidebar = $app->fileContent->get('font-awesome-sidebar.html');
    $content = $app->fileContent->get('font-awesome-content.html');
    //$trip1 = $app->fileContent->get('trip-1.html');
    //$trip2 = $app->fileContent->get('trip-2.html');
    //$trip3 = $app->fileContent->get('trip-3.html');

    $app->views->addString($content, 'main')
               ->addString($sidebar, 'sidebar')
               //->addString($trip1, 'triptych-1')
               //->addString($trip2, 'triptych-2')
               //->addString($trip3, 'triptych-3')
               ;

});

$app->router->handle();
$app->theme->render();
