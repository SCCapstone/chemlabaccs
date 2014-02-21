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
        $this->accidentid=$params['accidentid'];
        //$params['commentid'];
        //$this->$userID = $this->auth->get_user_id();
        $this->table = 'comments';
        
          if($params['cmd']=='print')
        {
              return $this->printComments();
        }
        
        else return $this->moveToDB ($comment);
        
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
    
    
    
    private function loadComments()
    {
        $this->CI->load->database();
        $sql = "SELECT * FROM comments WHERE accident_id=19492";
        $query = $this->CI->db->query($sql);    
        return $query;
    }
    
    
    private function printComments()
    {
        $query = $this->loadComments();
            echo "<h5><b>Accident Comments</b></h5>";
        foreach ($query->result() as $comment) {
         echo  '<div id="commentbox" style="padding-top:20px; padding-bottom:15px; margin-top:10px; height:100px;background-color:#f5f5f5; border:1px solid #dddddd;">
         <dl class="dl-horizontal">  <dt>Cooperd2</dt> <dt>'.$comment->comment_date.'<Date</d><dd>'.$comment->message.'</dd></dl></div>';  
            
        }
        
     
       
        
        
        
    }
    
    
}


