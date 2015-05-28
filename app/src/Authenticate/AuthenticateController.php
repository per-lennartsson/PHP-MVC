<?php

namespace Anax\Authenticate;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class AuthenticateController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function loginAction()
    {
        $this->initialize();
        $form = $this->form;

              $form = $form->create([], [
                  'username' => [
                      'type'        => 'text',
                      'label'       => 'Name:',
                      'required'    => true,
                      'placeholder' => 'Name',
                      'validation'  => ['not_empty'],
                  ],
                  'password' => [
                      'type'        => 'password',
                      'required'    => true,
                      'validation'  => ['not_empty'],
                  ],
                  'submit' => [
                      'type'      => 'submit',
                      'callback'  => function($form) {

                    $this->db->select()
                       ->from('user')
                       ->where("acronym = ?");

                    $this->db->execute([$form->Value('username')]);
                    $user = $this->db->fetchInto($this);

                    if(password_verify($form->Value('password'), $user->password))
                    {
                        $this->session->set('user', $user->id);
                    }
                      return true;
                  }
              ],

          ]);

          $status = $form->check();

          if ($status === true) {
             $url = $this->url->create('question');
             $this->response->redirect($url);

          } else if ($status === false) {
              $url = $this->url->create('authenticate/login');
             $this->response->redirect($url);
          }



          $this->theme->setTitle("Logga in");
          $this->views->add('login/view', [
              'content'         =>$form->getHTML(),
              'isAuthenticated' => $this->authenticate->isAuthenticated(),
              'checklogin'      =>$this->authenticate->getUserName(),
              'title'           => '<h2>Logga in</h2>',
          ]);
    }

    public function logoutAction()
    {
        if($this->session->has('user'))
        {
            $this->session->set('user', null);
        }
        $this->theme->setTitle("Logga ut");
        $this->views->add('login/view', [
            'content' => "Du har blivit utloggad",
            'checklogin' =>$this->authenticate->getUserId(),
            'title' => '<h2>Logga ut</h2>',
        ]);

    }




    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->authenticate = new \Anax\Authenticate\Authenticate();
        $this->authenticate->setDI($this->di);
    }

}
