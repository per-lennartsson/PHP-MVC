<?php
namespace Anax\Comment;
/**
 * A controller for comments and admin related events.
 *
 */
class CommentController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    public function aAction($answerId = null)
    {
            $this->initialize();
            $this->answerId = $answerId;
            $form = $this->form;
            $this->theme->setTitle('Fråga');

            $commentsAnswers = $this->comment->findAll(0,$answerId);
            $answer = $this->answer->find($answerId);


            $form = $form->create([], [
                'text' => [
                    'type'        => 'textarea',
                    'label'       => 'Text',
                    'required'    => true,
                    'placeholder' => 'content',
                    'validation'  => ['not_empty'],
                ],
                'submit' => [
                    'type'      => 'submit',
                    'callback'  => function($form) {

                    $now = date('Y-m-d H:i:s');

                    $this->comment->save([
                      'questionId' => 0,
                      'answerId' => $this->answerId,
                      'text'       => $this->textFilter->doFilter($form->value('text'), 'markdown'),
                      'userId'     => $this->authenticate->getUserId(),
                      'timestamp'  => $now,
                    ]);
                    return true;
                    }
                ],

            ]);

            $status = $form->check();

            if ($status === true) {
               $url = $this->url->create('question/id/' . $answer->questionId);
               $this->response->redirect($url);

            } else if ($status === false) {

            }


            $this->views->add('comment/view', [
                'answerForm'    => $form->getHTML(),
                'comments'      => $commentsAnswers,
                'answer'        => $answer,
                'authenticate'  => $this->authenticate->isAuthenticated(),
            ]);
    }

    public function qAction($questionId = null)
    {
        $this->initialize();
        $this->questionId = $questionId;
        $form = $this->form;
        $this->theme->setTitle('Fråga');
        $answer = $this->question->findById($questionId);

        $commentsQuestions = $this->comment->findAll($questionId,0);


        $form = $form->create([], [
            'text' => [
                'type'        => 'textarea',
                'label'       => 'Text',
                'required'    => true,
                'placeholder' => 'content',
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function($form) {

                $now = date('Y-m-d H:i:s');

                $this->comment->save([
                  'questionId' => $this->questionId,
                  'answerId'   => 0,
                  'text'       => $this->textFilter->doFilter($form->value('text'), 'markdown'),
                  'userId'     => $this->authenticate->getUserId(),
                  'timestamp'  => $now,
                ]);
                return true;
                }
            ],

        ]);

        $status = $form->check();

        if ($status === true) {
           $url = $this->url->create('question/id/'. $questionId);
           $this->response->redirect($url);

        } else if ($status === false) {
            $url = $this->url->create('question/id/'.$questionId);
           $this->response->redirect($url);
        }


        $this->views->add('comment/view', [
            'answerForm'    => $form->getHTML(),
            'comments'      => $commentsQuestions,
            'answer'        => $answer,
            'authenticate'  => $this->authenticate->isAuthenticated(),
        ]);
    }

    /**
     * Find comments for question or answer
     *
     * @param int $qId
     * @param int $aId
     *
     * @return objects
     */
    public function findAction($qId = null, $aId = 0)
    {
        return $this->comments->findAll($qId, $aId);
    }

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
        $this->answer = new \Anax\Answer\Answer();
        $this->answer->setDI($this->di);
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);
        $this->authenticate = new \Anax\Authenticate\Authenticate();
        $this->authenticate->setDI($this->di);
    }
}
