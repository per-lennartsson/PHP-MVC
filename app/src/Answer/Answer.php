<?php
namespace Anax\Answer;
/**
 * Model for Answers extends base model CDatabaseModel.
 *
 */
class Answer extends \Anax\MVC\CDatabaseModel
{

    /**
     * Find all answers with question id
     *
     * @param int $questionId for matching answers
     *
     * @return objects
     */
    public function findAll($id = null)
    {
        $this->db->select('a.*')
                 ->from("question AS q")
                 ->leftJoin('answer AS a', 'q.id = a.questionId')
                 ->where("q.id = ?");

        $this->db->execute([$id]);
        return $this->db->fetchAll();
    }

    public function find($id = null)
    {
        $this->db->select('*')
                 ->from("answer")
                 ->where("id = ?");

        $this->db->execute([$id]);
        return $this->db->fetchInto($this);
    }

    public function findByUser($id = null)
    {
        $this->db->select('*')
                  ->from('answer')
                  ->where('userId = ?');

        $this->db->execute([$id]);
        return $this->db->fetchAll();
   }


}
