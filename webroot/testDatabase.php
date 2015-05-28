<?php
// Get environment & autoloader.
require __DIR__.'/config.php';
// Create services and inject into the app.
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('form', '\Mos\HTMLForm\CForm');

$app = new \Anax\MVC\CApplicationBasic($di);


$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
    $db->connect();
    return $db;
});

$app->router->add('setup', function() use ($app) {

    //$app->db->setVerbose();

    $app->db->dropTableIfExists('user')->execute();

    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'password' => ['varchar(255)'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
        ]
    )->execute();

    $app->db->insert(
            'user',
            ['acronym', 'email', 'name', 'password', 'created', 'active']
        );

        $now = gmdate('Y-m-d H:i:s');

        $app->db->execute([
            'admin',
            'admin@dbwebb.se',
            'Administrator',
            password_hash('admin', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

        $app->db->execute([
            'doe',
            'doe@dbwebb.se',
            'John/Jane Doe',
            password_hash('doe', PASSWORD_DEFAULT),
            $now,
            $now
        ]);

      });
        $app->router->handle();
            $app->theme->render();
