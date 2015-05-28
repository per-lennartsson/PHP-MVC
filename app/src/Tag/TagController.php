<?php
namespace Anax\Tag;

/**
 * A controller for votes
 *
 */
class TagController implements \Anax\DI\IInjectionAware
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
        $all = $this->tags->findAll();
        $this->theme->setTitle('Taggar');
        $this->views->add('tag/list', [
            'tags' => $all,
        ]);
    }

    /**
     * View all comments.
     *
     * @return void
     */
    public function indexAction($limit=null,$sort=null)
    {
        $this->initialize();
        $all = $this->tags->findAllTag($limit,$sort);


        $this->views->add('tag/index', [
                'tags' => $all,
            ], 'sidebar'
        );
    }

    /**
     * View all comments.
     *
     * @return void
     */
    public function visaAction()
    {
        $this->initialize();
        $all = $this->tags->findAll();
        $this->theme->setTitle('Taggar');
        $this->views->add('tag/list', [
            'tags' => $all,
        ]);
    }
    public function tagAction($tag = null)
    {

        $this->initialize();
        $this->theme->setTitle('Tagg');
        $questions = $this->question->findByTag($tag);
        $this->views->add('tag/view', [
            'tag'       => $tag,
            'questions' => $questions,
        ]);
    }

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->tags = new \Anax\Tag\Tag();
        $this->tags->setDI($this->di);
        $this->question = new \Anax\Question\Question();
        $this->question->setDI($this->di);
    }

}
