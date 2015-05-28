<?php

namespace Anax\Authenticate;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class AuthenticateController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function viewAction()
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

          $this->views->add('login/view', [
              'content' =>$form->getHTML(),
              'checklogin' =>$this->isAuthenticated(),
              'title' => '<h2>Logga in</h2>',
          ]);
    }

    public function logoutAction()
    {
        $this->views->add('login/view', [
            'content' => "Du har blivit utloggad",
            'checklogin' =>$this->isAuthenticated(),
            'title' => '<h2>Logga ut</h2>',
        ]);

    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->session->has('user') ? true : false;
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
