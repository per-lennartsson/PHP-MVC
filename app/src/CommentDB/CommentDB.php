<?php
namespace Anax\CommentDB;

/**
 * Model for Comments.
 *
 */
class CommentDB extends \Anax\MVC\CDatabaseModel
{
    public function setupComment($commentPage){

        $this->db->setVerbose(false);

        $this->db->dropTableIfExists($commentPage)->execute();

        $this->db->createTable(
            $commentPage,
            [
                'id' => ['integer', 'primary key', 'not null', 'auto_increment'],
                'content'   =>  ['text', 'not null'],
                'email' => ['varchar(80)'],
                'name' => ['varchar(80)'],
                'web'       =>  ['varchar(80)'],
                'timestamp' =>  ['datetime'],
            ]
        )->execute();

        $this->db->insert(
            $commentPage,
            ['content', 'email', 'name', 'web', 'timestamp']
        );

        $now = date('Y-m-d H:i:s');

        $this->db->execute([
            'Comment test',
            'admin@dbwebb.se',
            'Administrator',
            'dbwebb.se',
            $now,
        ]);

        $this->db->execute([
            'cmment test12',
            'perlennartsson@outlook.com',
            'Per Lennartsson',
            'per-lennartsson.se',
            $now,
        ]);
    }
}
