<?php

namespace Anax\CommentDB;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentdbController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function setupAction($commentPage)
    {
        $this->initialize();
        $this->comment->setupComment($commentPage);
        $this->theme->setTitle('Återställ databasen');
        $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');

    }

    /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction($commentPage)
    {
        $this->initialize();
        $all = $this->comment->findAll();

        $this->views->add('commentdb/comments', [
            'comments' => $all,
        ]);
    }



    /**
     * Add a comment.
     *
     * @return void
     */
    public function addAction()
    {
        $this->initialize();
        $form = $this->form;

              $form = $form->create([], [
                  'name' => [
                      'type'        => 'text',
                      'label'       => 'Name:',
                      'required'    => true,
                      'placeholder' => 'Name',
                      'validation'  => ['not_empty'],
                  ],
                  'email' => [
                      'type'        => 'text',
                      'required'    => true,
                      'placeholder' => 'email address',
                      'validation'  => ['not_empty', 'email_adress'],
                  ],
                  'content' => [
                      'type'        => 'text',
                      'label'       => 'Content',
                      'required'    => true,
                      'placeholder' => 'content',
                      'validation'  => ['not_empty'],
                  ],
                  'web' => [
                      'type'        => 'text',
                      'label'       => 'Web address',
                      'required'    => true,
                      'placeholder' => 'Web address',
                      'validation'  => ['not_empty'],
                  ],
                  'submit' => [
                      'type'      => 'submit',
                      'callback'  => function($form) {

                      $now = date('Y-m-d H:i:s');

                      $this->comment->save([
                        'name'      => $form->Value('name'),
                        'email'     => $form->Value('email'),
                        'content'   => $form->Value('content'),
                        'web'       => $form->Value('web'),
                        'timestamp' => $now,
                      ]);

                      return true;
                  }
              ],

          ]);

          // Check the status of the form
          $status = $form->check();

          if ($status === true) {
             $url = $this->url->create('commentdb');
             $this->response->redirect($url);

          } else if ($status === false) {
              $url = $this->url->create('commentdb');
             $this->response->redirect($url);
          }


          $this->theme->setTitle("Lägg till kommentar");

          $this->views->add('commentdb/add', [
              'content' =>$form->getHTML(),
              'title' => '<h2>Skapa en ny kommentar</h2>',
          ]);
    }


    /**
     * Edit comment.
     *
     * @return void
     */
    public function editAction($id)
    {
        $this->initialize();

        $form = $this->form;

        $comment = $this->comment->find($id);

        $form = $form->create([], [
            'name' => [
                'type'        => 'text',
                'label'       => 'Name:',
                'required'    => true,
                'placeholder' => 'Name',
                'validation'  => ['not_empty'],
                'value'       => $comment->name,
            ],
            'email' => [
                'type'        => 'text',
                'required'    => true,
                'placeholder' => 'email address',
                'validation'  => ['not_empty', 'email_adress'],
                'value'       => $comment->email,
            ],
            'content' => [
                'type'        => 'text',
                'label'       => 'Content',
                'required'    => true,
                'placeholder' => 'content',
                'validation'  => ['not_empty'],
                'value'       => $comment->content,
            ],
            'web' => [
                'type'        => 'text',
                'label'       => 'Web address',
                'required'    => true,
                'placeholder' => 'Web address',
                'validation'  => ['not_empty'],
                'value'       => $comment->web,
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function($form) use ($comment) {

               $now = date('Y-m-d H:i:s');

            $this->comment->save([
                'id'        => $comment->id,
                'name'      => $form->Value('name'),
                'email'     => $form->Value('email'),
                'content'   => $form->Value('content'),
                'web'       => $form->Value('web'),
                'timestamp' => $now,
                    ]);

            return true;
            }
            ],

        ]);

        // Check the status of the form
        $status = $form->check();

        if ($status === true) {
             $url = $this->url->create('commentdb');
             $this->response->redirect($url);

        } else if ($status === false) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

            $this->theme->setTitle("Uppdatera en kommentar");


            $this->views->add('commentdb/edit', [
                'content' =>$form->getHTML(),
                'title' => '<h2>Uppdatera en kommentar</h2>',
            ]);

    }

    /**
     * Remove comment.
     *
     * @return void
     */
    public function removeAction($id=null)
    {
        $this->initialize();
        if (!isset($id)) {
            die("Missing id");
        }

        $res = $this->comment->delete($id);

        $url = $this->url->create('commentdb');
        $this->response->redirect($url);
    }

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->comment = new \Anax\CommentDB\CommentDB();
        $this->comment->setDI($this->di);
    }
}
