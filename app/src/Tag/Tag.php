<?php
namespace Anax\Tag;

/**
 * Model for Tags.
 *
 */
class Tag extends \Anax\MVC\CDatabaseModel
{

    public function saveTag($tags, $questionId)
    {
        $tags= explode(',', $tags);
        foreach($tags as $tag)
       {
           $tag = str_replace(" ", "", $tag);
           $tag = ucfirst ($tag);
           $this->db->select('nameTag')->
           from('tag')->
           where('nameTag = ?');

           $this->db->execute([$tag]);
           $res = $this->db->fetchAll();
           if (!$res)
           {
               $this->db->insert(
               'tag',
               ['nameTag']
                );

                $this->db->execute([
                $tag
                ]);
            }

            $this->db->select('id')->
            from('tag')->
            where('nameTag = ?');
            $this->db->execute([$tag]);
            $this->db->fetchInto($this);


            $this->db->insert(
            'question_tag',
            ['question_id', 'tag_id']
             );

             $this->db->execute([
             $questionId, $this->id
             ]);

       }
    }

    public function findAllTag($limit = null, $sort = null)
    {
        $this->db->select('*')->
        from('tag');

        if(!is_null($limit) && !empty($limit))
        {
        $this->db->limit($limit);
        }
        if(!is_null($sort) && !empty($sort))
        {
        $this->db->orderby('rankTag '.$sort);
        }
        $this->db->execute();
        $res = $this->db->fetchAll();
        return $res;

    }

}
