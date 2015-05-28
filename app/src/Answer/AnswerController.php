<?php

namespace Anax\Answer;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class AnswerController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Display all answers and corresponding comments based on question id
     *
     * @param int $questionId
     *
     * return void
     */
    public function viewAllAction($questionId = null)
    {
        $answers = $this->answers->findAll($questionId);

        foreach($answers as $answer)
        {
        $this->views->add('wgtotw/answer', [
            'answer' => $answer,
            'owner' => ($this->isOwner($answer->userId) ? true : ($this->isAdmin() ? true : false))
        ]);

        $this->dispatcher->forward([
                'controller'    => 'comments',
                'action'        => 'view',
                'params'        => [$questionId, $answer->id]
            ]);

        $this->dispatcher->forward([
                'controller'    => 'comments',
                'action'        => 'add',
                'params'        => [$questionId, $answer->id]
            ]);

        }
    }



    public function findAllForQuestion($questionId = null)
    {
        $this->initialize();
        $this->answer->findAllForQuestion();

    }

    /**
   * Initialize the controller.
   *
   * @return void
   */
  public function initialize()
  {
      $this->answer = new \Anax\Answer\Answer();
      $this->answer->setDI($this->di);
  }

}
