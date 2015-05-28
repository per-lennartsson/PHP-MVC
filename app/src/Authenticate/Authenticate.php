<?php
namespace Anax\Authenticate;
/**
 * Model for Answers extends base model CDatabaseModel.
 *
 */
class Authenticate extends \Anax\MVC\CDatabaseModel
{

    /**
     * Ged users id
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->session->get('user');
    }

    public function getUserName()
    {
        $this->db->select('acronym')->
        from('user')->
        where('id = ?');

        $this->db->execute([$this->getUserId()]);
        $user = $this->db->fetchInto($this);
        if(isset($user->acronym)){
            return $user->acronym;
        }
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

}
