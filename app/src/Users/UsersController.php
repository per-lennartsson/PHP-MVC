<?php

namespace Anax\Users;

/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function indexAction()
    {
        $this->theme->setTitle('User start page');
        $this->views->add('users/index', [
            'title' => "User start page",
        ]);
    }

    /**
     * V
     *
     * @return void
     */
    public function ViewAction($limit=null,$sort=null)
    {
        $this->initialize();
        $all = $this->users->findAll($limit,$sort);
        $this->views->add('users/page', [
            'users' => $all,
        ]);
    }

    /**
     * List all users.
     *
     * @return void
     */
    public function listAction()
    {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);

        $all = $this->users->findAll();

        $this->theme->setTitle("List all users");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "View all users",
        ]);
    }

    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null)
    {
        $this->initialize();

        $user = $this->users->find($id);
        $questions = $this->question->findByUser($id);
        $answers = $this->answer->findByUser($id);
        $comments = $this->comment->findByUser($id);

        $this->theme->setTitle("View user with id");

        $this->views->add('users/sidebar', [
            'user'  => [
                'title' => "Om användaren",
                'user'  => $user,
                ],
            ], 'sidebar'
        );

        $this->views->add('users/view', [
            'questions' => $questions,
            'answers' => $answers,
            'comments' => $comments,
            'title' => 'Frågor från användaren',
        ]);
    }


    /**
     * Add new user.
     *
     * @param string $acronym of user to add.
     *
     * @return void
     */
    public function registerAction($acronym = null)
    {
        $form = $this->form;

              $form = $form->create([], [
                  'acronym' => [
                      'type'        => 'text',
                      'label'       => 'Acronym',
                      'required'    => true,
                      'placeholder' => 'Acronym',
                      'validation'  => ['not_empty'],
                  ],
                  'password' => [
                      'type'        => 'password',
                      'label'       => 'Password',
                      'required'    => true,
                      'placeholder' => 'password',
                      'validation'  => ['not_empty'],
                  ],
                  'name' => [
                      'type'        => 'text',
                      'label'       => 'Name of contact person:',
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
                  'about' => [
                      'type'        => 'textarea',
                      'label'       => 'Om',
                  ],
                  'submit' => [
                      'type'      => 'submit',
                      'callback'  => function($form) {

                      $now = date('Y-m-d H:i:s');

                      $this->users->save([
                        'acronym'   => $form->Value('acronym'),
                        'email'     => $form->Value('email'),
                        'name'      => $form->Value('name'),
                        'password'  => password_hash($form->Value('password'), PASSWORD_DEFAULT),
                        'about'     => $this->textFilter->doFilter($form->value('about'), 'markdown'),
                        'created'   => $now,
                        'active'    => $now,
                      ]);

                      return true;
                  }
              ],

          ]);

          // Check the status of the form
          $status = $form->check();

          if ($status === true) {

              $form->AddOutput("Den nya användaren är nu i användarlistan.");
              $this->flash->setMessage('info', "created");
              $url = $this->url->create('users/list');
              $this->response->redirect($url);

          } else if ($status === false) {

              $form->AddOutput("Den nya användaren las inte till i databasen.");
              $url = $this->url->create('users/add');
             $this->response->redirect($url);
          }

          $this->theme->setTitle("Lägg till användare");

          $this->views->add('users/add', [
              'content' =>$form->getHTML(),
              'title' => '<h2>Skapa en ny användare</h2>',
              'authenticate' => $this->authenticate->isAuthenticated(),
          ]);
    }


    /**
        * Edit user.
        *
        * @param int id of user.
        *
        * @return void
        */
       public function updateAction($id = null)
       {
           $user = null;
           $form = null;
           $id = $this->authenticate->getUserId();

           if(isset($id)){
               $form = $this->form;
               $user = $this->users->find($id);
               $form = $form->create([], [
                   'name' => [
                       'type'        => 'text',
                       'label'       => 'Name of contact person:',
                       'required'    => true,
                       'validation'  => ['not_empty'],
                       'value' => $user->name,
                   ],
                   'email' => [
                       'type'        => 'text',
                       'required'    => true,
                       'validation'  => ['not_empty', 'email_adress'],
                       'value' => $user->email,
                   ],
                   'about' => [
                       'type'        => 'textarea',
                       'label'       => 'Name of contact person:',
                       'value' => $user->about,
                   ],
                   'submit' => [
                       'type'      => 'submit',
                       'callback'  => function($form) use ($user) {

                      $now = date('Y-m-d H:i:s');

                   $this->users->save([
                        'id'        => $user->id,
                        'acronym'   => $form->Value('acronym'),
                        'email'     => $form->Value('email'),
                        'name'      => $form->Value('name'),
                        'about'     => $this->textFilter->doFilter($form->value('about'), 'markdown'),
                        'updated'   => $now,
                        'active'    => $now,
                           ]);

                   return true;
                   }
                   ],

               ]);

               // Check the status of the form
               $status = $form->check();

               if ($status === true) {
                    $form->AddOutput("Användaren har uppdaterats.");
                    $url = $this->url->create('users/id/' . $user->id);
                    $this->response->redirect($url);

               } else if ($status === false) {
                       $form->AddOutput("Användaren uppdaterades inte.");
                   header("Location: " . $_SERVER['PHP_SELF']);
                   exit;
               }
            }
               $this->theme->setTitle("Uppdatera en användare");

               if(isset($user->acronym))
               {
                   $user= $user->acronym;
               }

               if (isset($form))
               {
                   $form = $form->getHTML();
               }


               $this->views->add('users/edit', [
                   'content' => $form,
                   'title'   => '<h2>Uppdatera en användare</h2>',
                   'user'    => $user,
                   'userAuthenticate' => $this->authenticate->getUserName(),
                   'authenticate'   => $this->authenticate->isAuthenticated(),
               ]);
   }

    /**
     * Delete user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function deleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $res = $this->users->delete($id);

        $url = $this->url->create('users/list');
        $this->response->redirect($url);
    }

    /**
     * Delete (soft) user.
     *
     * @param integer $id of user to delete.
     *
     * @return void
     */
    public function softDeleteAction($id = null)
    {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = gmdate('Y-m-d H:i:s');

        $user = $this->users->find($id);

        $user->deleted = $now;
        $user->save();

        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }

    /**
     * List all active and not deleted users.
     *
     * @return void
     */
    public function activeAction()
    {
        $all = $this->users->query()
           ->where('active != 0 OR active is NOT NULL')
           ->andWhere('deleted = 0 OR deleted is NULL')
           ->andWhere('deactivate = 0 OR deactivate is NULL')
           ->execute();

        $this->theme->setTitle("Users that are active");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are active",
        ]);
    }

    public function activateAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date('Y-m-d H:i:s');

        $user = $this->users->find($id);
                $user->active = $now;
                $user->deactivate = 'null';
                $user->save();
                $feedback = $user->acronym . " är nu aktiverad.";
                 $this->listAction($feedback);
    }

    public function deactivateUserAction($id = null) {
        if (!isset($id)) {
            die("Missing id");
        }

        $now = date('Y-m-d H:i:s');

        $user = $this->users->find($id);
                $user->active = 'null';
                $user->deactivate = $now;
                $user->save();
                $feedback = $user->acronym . " är nu inaktiv.";
                 $this->listAction($feedback);
    }

    public function deactivateAction()
    {
        $all = $this->users->query()
            ->where('deactivate != 0 OR deactivate is NOT NULL')
            ->andWhere('deleted = 0 OR deleted is NULL')
            ->andWhere('active = 0 OR active is NULL')
            ->execute();

        $this->theme->setTitle("Users that are deactivate");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Users that are deactivate",
        ]);
    }

    public function softdeleteuserAction($id = null)
    {
    if (!isset($id)) {
        die("Missing id");
    }

    $now = date('Y-m-d H:i:s');

    $user = $this->users->find($id);


            $user->deleted = $now;
            $user->active = null;
            $user->deactivate = null;
            $user->save();
            $feedback = $user->acronym . " är nu i papperskorgen.";
            $this->listAction($feedback);
    }

    public function undosoftdeleteuserAction($id = null)
    {
    if (!isset($id)) {
        die("Missing id");
    }

    $now = date('Y-m-d H:i:s');

    $user = $this->users->find($id);


            $user->deleted = null;
            $user->active = $now;
            $user->deactivate = null;
            $user->save();
            $feedback = $user->acronym . " är nu i papperskorgen.";
            $this->listAction($feedback);
    }

    public function deletedAction()
    {
        $all = $this->users->query()
            ->where('deleted != 0 OR deleted is NOT NULL')
            ->andWhere('active = 0 OR active is NULL')
            ->andWhere('deactivate = 0 OR deactivate is NULL')
            ->execute();

        $this->theme->setTitle("Users that are active");
        $this->views->add('users/list-all', [
            'users' => $all,
            'title' => "Användare i papperskorgen",
        ]);
    }

    public function setupAction()
    {
        $this->users->setupUsers();
        $this->theme->setTitle('Återställ databasen');
        $this->views->addString('<h1>Återställ databasen</h1><p>Nu är databasen återställd.</p>');

    }

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);
        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);
        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
        $this->tag = new \Anax\Tag\Tag();
        $this->tag->setDI($this->di);
        $this->authenticate = new \Anax\Authenticate\Authenticate();
        $this->authenticate->setDI($this->di);
    }



}
