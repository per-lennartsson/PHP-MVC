<?php
namespace Anax\Question;

/**
 * Model for Comments.
 *
 */
class Question extends \Anax\MVC\CDatabaseModel
{

    public function findLatest($limit = null)
       {
           $this->db->select('DISTINCT q.*, u.acronym as acronym, u.id as acronymId, COUNT(DISTINCT a.id) AS answers, GROUP_CONCAT(t.nameTag) AS tags')
                     ->from('question AS q')
                     ->leftJoin('answer AS a', 'q.id = a.questionId')
                     ->leftJoin('question_tag AS q2t', 'q.id = q2t.question_id')
                     ->leftJoin('tag AS t', 'q2t.tag_id = t.id')
                     ->leftJoin('user AS u', 'q.userId = u.id')
                     ->groupby('q.id, a.questionId')
                     ->orderby('q.id DESC');
           if(!is_null($limit) && !empty($limit))
           {
           $this->db->limit($limit);
           }
           $this->db->execute();
           $this->db->setFetchModeClass(__CLASS__);
           $result = $this->db->fetchAll();

           return $result;
       }

    public function findAll($limit = null, $sort = null)
      {
          $this->db->select('*')
          ->from('question');
          if(!is_null($limit) && !empty($limit))
          {
          $this->db->limit($limit);
          }
          if(!is_null($sort) && !empty($sort))
          {
          $this->db->orderby('id '.$sort);
          }
          $this->db->execute();
          $res = $this->db->fetchAll();
          return $res;

          $this->db->execute();
          $result = $this->db->fetchAll();
          return $result;
     }

    public function findById($id)
    {
         $this->db->select('q.*, u.acronym as acronym, u.id as acronymId ,  a.id AS answers, GROUP_CONCAT(t.nameTag) AS tags')
                   ->from('question AS q')
                   ->leftJoin('answer AS a', 'q.id = a.questionId')
                   ->leftJoin('question_tag AS q2t', 'q.id = q2t.question_id')
                   ->leftJoin('tag AS t', 'q2t.tag_id = t.id')
                   ->leftJoin('user AS u', 'q.userId = u.id')
                   ->where("q.id = ?");

         $this->db->execute([$id]);
         return $this->db->fetchInto($this);
    }

    public function findByTag($tag)
    {
        $this->db->select('id')
                  ->from('tag')
                  ->where("nameTag = ?");
        $this->db->execute([$tag]);
        $this->db->fetchInto($this);

         $this->db->select('*')
                   ->from('question AS q')
                   ->leftJoin('question_tag AS q2t', 'q.id = q2t.question_id')
                   ->where("q2t.tag_id = ?");

         $this->db->execute([$this->id]);
         return $this->db->fetchAll();
    }

    public function findByUser($id)
    {

         $this->db->select('*')
                   ->from('question')
                   ->where('userId = ?');

         $this->db->execute([$id]);
         return $this->db->fetchAll();
    }

    public function findAllbyId($id){
        $this->db->select('q.*,a.*, u.name')
                  ->from('question AS q')
                  ->leftJoin('answer AS a','q.id = a.questionID')
                  ->leftJoin('user AS u','u.id = a.questionID')
                  ->where('q.id = ?');
        $this->db->execute([$id]);
        return $this->db->fetchAll();
      }

}
