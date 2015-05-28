<?php
namespace Anax\Users;

/**
 * Model for Users.
 *
 */
class User extends \Anax\MVC\CDatabaseModel
{
    public function getUserNameFromId($id = null)
    {
        $this->db->select('acronym')->
        from('user')->
        where('id = ?');

        $this->db->execute([$id]);
        $user = $this->db->fetchInto($this);
        return $user->acronym;

    }

    public function findAll($limit = null, $sort = null)
    {
        $this->db->select('*')->
        from('user');

        if(!is_null($limit) && !empty($limit))
        {
        $this->db->limit($limit);
        }
        if(!is_null($sort) && !empty($sort))
        {
        $this->db->orderby('rank '.$sort);
        }
        $this->db->execute();
        $res = $this->db->fetchAll();
        return $res;

    }


}
