<?php
namespace Anax\Comment;
/**
 * Model for Comments.
 *
 */
class Comment extends \Anax\MVC\CDatabaseModel
{

    /**
     * Find all comments for question or answer
     *
     * @param int $qId
     * @param int $aId
     *
     * @return objects
     */
    public function findAll($qId = 0, $aId = 0)
    {
        $this->db->select('c.*')
                 ->from('comment AS c')
                 ->where("c.questionId = ?")
                 ->andWhere("c.answerId = ?");

        $this->db->execute([$qId, $aId]);
        $this->db->setFetchModeClass(__CLASS__);
        return $this->db->fetchAll();
    }

    public function findByUser($id = null)
    {
        $this->db->select('*')
                 ->from("comment")
                 ->where("userId = ?");

        $this->db->execute([$id]);
        return $this->db->fetchAll();
    }

}
