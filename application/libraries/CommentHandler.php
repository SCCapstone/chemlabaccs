<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommentHandler
 *
 * @author allen_000
 */
class CommentHandler {
    private $CI; 
    private $accidentid;
    private $userID;
    private $table = "";        
    public function __construct($params)
    {
        $this->CI = &get_instance();
        $params[$accidentid];
        $this->getComment();
        $this->$userID = $this->auth->get_user_id();
        $this->table = 'comments';
    }
    
    private function getComment ()
    {
        
        $accidentid = $this->accidentid;
        $comment = $_POST['comment'];
        if(!empty($comment))
        {
            $this->moveToDB($comment);
        }
    }
    
    
    private function moveToDB ($comment)
    {
        $date = ('Y-m-d');
        $time = time();
        $userID = $this->userID;
        $commentData = array(
            'user_id' => $userID, 
            'accident_id' => $this->accidentid,
            'message' => $comment,
            'date' => $date,
            'time' => $time
        );
        $this->CI->load->database();
        $this->CI->db->insert($this->table, $commentData);
    }
    
}
