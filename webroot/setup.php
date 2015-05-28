<?php
/**
 * This is a Anax frontcontroller.
 *
 */
// Get environment & autoloader.
require __DIR__.'/config_with_app.php';
// Add service
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
    $db->connect();
    return $db;
});
// Theme
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');
// Set url type
$app->url->setUrlType(\Anax\Url\Curl::URL_CLEAN);
// Setup
$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Setup");

    $app->db->dropTableIfExists('question_tag')->execute();
    $app->db->dropTableIfExists('tag')->execute();
    $app->db->dropTableIfExists('user')->execute();
    $app->db->dropTableIfExists('comment')->execute();
    $app->db->dropTableIfExists('question')->execute();
    $app->db->dropTableIfExists('answer')->execute();

    $app->views->add('me/page', ['content' => 'Databasen är återställd'], 'main');

    $app->db->createTable(
        'user',
        [
            'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
            'acronym' => ['varchar(20)', 'unique', 'not null'],
            'email' => ['varchar(80)'],
            'name' => ['varchar(80)'],
            'about' => ['text'],
            'password' => ['varchar(255)'],
            'rank'      =>['integer'],
            'created' => ['datetime'],
            'updated' => ['datetime'],
            'deleted' => ['datetime'],
            'active' => ['datetime'],
            'deactivate' => ['datetime']
        ]
    )->execute();

    $app->db->insert(
        'user',
        ['acronym', 'email', 'name', 'about' , 'password', 'rank' , 'created', 'updated', 'deleted', 'active', 'deactivate' ]
    );

    $now = date('Y-m-d H:i:s');

    $app->db->execute([
        'admin',
        'admin@dbwebb.se',
        'Administrator',
        'om användaren',
        password_hash('admin', PASSWORD_DEFAULT),
        2,
        $now,
        $now,
        'null',
        'null',
        $now
    ]);

    $app->db->execute([
        'doe',
        'doe@dbwebb.se',
        'John/Jane Doe',
        '',
        password_hash('doe', PASSWORD_DEFAULT),
        1,
        $now,
        $now,
        'null',
        'null',
        $now
    ]);


    $app->db->createTable(
        'comment',
        [
            'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
            'questionId'     => ['integer'],
            'answerId'       => ['integer'],
            'text'      => ['text', 'not null'],
            'userId'    => ['integer'],
            'timestamp'   => ['datetime'],
        ]
    )->execute();

	$app->db->insert(
        'comment',
        ['questionId', 'answerId', 'text', 'userId', 'timestamp']
    );

    $now = gmdate('Y-m-d H:i:s');

    $app->db->execute([
        1,
        0,
        'kommentar till fråga 1',
        1,
        $now
    ]);

    $app->db->execute([
        1,
        0,
        'kommentar 2 till fråga 1',
        1,
        $now
    ]);

    $app->db->createTable(
        'question',
        [
            'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
            'title'     => ['varchar(100)'],
            'text'      => ['text', 'not null'],
            'userId'    => ['integer'],
            'timestamp'   => ['datetime'],
        ]
    )->execute();

    $app->db->insert(
        'question',
        ['title', 'text', 'userId', 'timestamp']
    );

    $now = gmdate('Y-m-d H:i:s');

    $app->db->execute([
        'testfråga1',
        'testfråga',
        1,
        $now
    ]);

    $app->db->execute([
        'testfråga2',
        'testfråga',
        2,
        $now
    ]);



    $app->db->createTable(
        'answer',
        [
            'id'            => ['integer', 'primary key', 'not null', 'auto_increment'],
            'questionId'    => ['integer'],
            'text'          => ['text', 'not null'],
            'userId'        => ['integer'],
            'timestamp'     => ['datetime'],
        ]
    )->execute();

    $app->db->insert(
        'answer',
        ['questionId', 'text', 'userId', 'timestamp']
    );

    $now = gmdate('Y-m-d H:i:s');

    $app->db->execute([
        1,
        'svar till fråga 1',
        1,
        $now
    ]);

    $app->db->execute([
        1,
        'svar 2 till fråga 1',
        2,
        $now
    ]);


    $app->db->createTable(
        'tag',
        [
            'id'        => ['integer', 'primary key', 'not null', 'auto_increment'],
            'nameTag'       => ['varchar(80)', 'not null', 'unique'],
            'rankTag'       => ['integer'],
        ]
    )->execute();

    $app->db->insert(
        'tag',
        ['nameTag', 'rankTag']
    );

    $app->db->execute([
        'Tag1',
        2
    ]);

    $app->db->execute([
        'Tag2',
        1
    ]);

    // Create question2movie and insert default values
    $sql = "CREATE TABLE anax_question_tag
    (
      question_id INT NOT NULL,
      tag_id INT NOT NULL,

      FOREIGN KEY (question_id) REFERENCES anax_question (id),
      FOREIGN KEY (tag_id) REFERENCES anax_tag (id),

      PRIMARY KEY (question_id, tag_id)
    );";
    $app->db->execute($sql);

    $app->db->insert(
        'question_tag',
        ['question_id', 'tag_id']
    );

    $app->db->execute([
        1,2
    ]);
    $app->db->execute([
        1,1
    ]);

    $app->db->execute([
        2,1
    ]);

});
// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();
// Navbar
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
// Render the page
$app->theme->render();
