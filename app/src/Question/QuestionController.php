<?php

namespace Anax\Question;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class QuestionController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction()
    {
        $this->initialize();
        $questions = $this->question->findLatest();
        $this->theme->setTitle('Frågor');
        $count= 0;
                foreach($questions as $question) {

                    $answers[$question->id][] = $this->answer->findAll($question->id);

                    foreach ($answers[$question->id][0] as $answer) {
                        $commentsAnswers[$answer->id][] = $this->comment->findAll(0,$answer->id);
                    }

                    $commentsQuestions[$question->id][] = $this->comment->findAll($question->id,0);
                    $count++;
                }


        $this->views->add('question/list', [
            'questions' => $questions,
            'commentsQuestions' => $commentsQuestions,
            'answers'   => $answers,
            'commentsAnswers' => $commentsAnswers,
        ]);
    }

    public function indexAction($limit=null,$sort=null)
    {
        $this->initialize();
        $all = $this->question->findAll($limit,$sort);
        $this->views->add('question/index', [
            'questions' => $all,
        ]);
    }

    public function idAction($questionId = null)
    {
        $this->initialize();
        $this->questionId=$questionId;
        $form = $this->form;


        $question = $this->question->findById($questionId);
        $this->theme->setTitle('Fråga');


        $answers[] = $this->answer->findAll($question->id);

        foreach ($answers[0] as $answer) {
        $commentsAnswers[$answer->id][] = $this->comment->findAll(0,$answer->id);
        }
        $commentsQuestions[] = $this->comment->findAll($question->id,0);

        $form = $form->create([], [
            'text' => [
                'type'        => 'textarea',
                'label'       => 'Svara på frågan',
                'required'    => true,
                'placeholder' => 'content',
                'validation'  => ['not_empty'],
            ],
            'submit' => [
                'type'      => 'submit',
                'callback'  => function($form) {

                $now = date('Y-m-d H:i:s');

                $this->answer->save([
                  'questionId' => $this->questionId,
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
           $url = $this->url->create('question/id/'.$questionId);
           $this->response->redirect($url);

        } else if ($status === false) {
            $url = $this->url->create('question/id/'.$questionId);
           $this->response->redirect($url);
        }


        $this->views->add('question/view', [
            'question' => $question,
            'commentsQuestions' => $commentsQuestions,
            'answers'           => $answers,
            'answerForm'        => $form->getHTML(),
            'authenticate'      => $this->authenticate->isAuthenticated(),
            'commentsAnswers'   => $commentsAnswers,
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
                  'title' => [
                      'type'        => 'text',
                      'label'       => 'title:',
                      'required'    => true,
                      'placeholder' => 'Name',
                      'validation'  => ['not_empty'],
                  ],
                  'text' => [
                      'type'        => 'textarea',
                      'label'       => 'Content',
                      'required'    => true,
                      'placeholder' => 'content',
                      'validation'  => ['not_empty'],
                  ],
                  'tags' => [
                      'type'        => 'text',
                      'label'       => 'Taggar(Sepparera taggarna med ",")',
                      'required'    => true,
                      'validation'  => ['not_empty'],
                  ],
                  'submit' => [
                      'type'      => 'submit',
                      'callback'  => function($form) {

                      $now = date('Y-m-d H:i:s');

                      $this->question->save([
                        'title'      => $form->Value('title'),
                        'text'       => $this->textFilter->doFilter($form->value('text'), 'markdown'),
                        'userId'     => $this->authenticate->getUserId(),
                        'timestamp'  => $now,
                      ]);

                      $this->db->select('id')->
                      from('question')->
                      orderby('id DESC')->
                      limit(1);
                      $this->db->execute();
                      $this->db->fetchInto($this);
                      $this->tag->saveTag($form->Value('tags'),$this->id);
                      return true;
                  }
              ],

          ]);

          // Check the status of the form
          $status = $form->check();

          if ($status === true) {
             $url = $this->url->create('question');
             $this->response->redirect($url);

          } else if ($status === false) {
              $url = $this->url->create('question/add');
             $this->response->redirect($url);
          }


          $this->theme->setTitle("Ny Fråga");

          $this->views->add('question/add', [
              'content' =>$form->getHTML(),
              'title' => '<h2>Skapa en ny kommentar</h2>',
              'authenticate'  => $this->authenticate->isAuthenticated(),
          ]);
    }

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
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
