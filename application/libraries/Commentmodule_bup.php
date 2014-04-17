<?php

/**
 * This class creates a new instance of a comment module
 * Modified by D.Cooper 2/23/2014
 */
class Commentmodule {

    private $CI;
    private $accidentid;
    private $userID;
    private $table = "";
    private $comment;

  /********************************************************************************/
    public function __construct($params) {
        $this->CI = &get_instance();
        $this->accidentid=$params['accidentid'];
        return $this->loadModule();
        
    }
/********************************************************************************/

    private function requestComments() {
        $this->CI->load->database();
        $sql = "SELECT * FROM comments WHERE accident_id=$this->accidentid ORDER BY comment_time DESC";
        $query = $this->CI->db->query($sql);
        return $query;
    }
    
/********************************************************************************/
    private function getUser($userid){
       $this->CI->load->database();
        $sql = "SELECT * FROM users WHERE id=$userid";
        $query = $this->CI->db->query($sql);
        $row= $query->row();
        $email = $row->email;
        $email = array_shift(explode('@', $email));
        return $email;
    
    }
/********************************************************************************/


    private function loadModule() {
        $now = time();
        $this->CI->load->helper('date');
        $query = $this->requestComments();
        echo '<div class="list-group" id="comment_list">';
        foreach ($query->result() as $comment) {
            echo '<a href="#" class="list-group-item">';
            echo '<h5 class="list-group-item-heading"><b>'.$this->getUser($comment->user_id).'</b><small>      - '. timespan($comment->comment_time, $now).' ago</small></h5>';
            echo '<p class="list-group-item-text">' . $comment->message . '</p> </a>';

            // echo  '<div id="commentbox" style="padding-top:20px; padding-bottom:15px; margin-top:10px; height:100px;background-color:#f5f5f5; border:1px solid #dddddd;">
            //  <dl class="dl-horizontal">  <dt>Cooperd2</dt> <dt>'.$comment->comment_date.'<Date</d><dd>'.$comment->message.'</dd></dl></div>';  
        }
        echo '</div>';
    }

}

