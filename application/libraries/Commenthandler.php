<?php

/**
 * The Comment Handler class is responsible for inserting, displaying, and removing comments from the Chemlabaccs Application
 * Modified by D.Cooper 2/23/2014
 * @author David Allen
 */
class CommentHandler {

    private $CI;
    private $accidentid;
    private $userID;
    private $table = "";
    private $comment;

  /********************************************************************************/
    public function __construct($params) {
        $this->CI = &get_instance();
        $this->accidentid = $params['accidentid'];
        $this->userID=$params['userid'];
        $this->comment = $params['comment'];
        //$params['commentid'];
        //$this->$userID = $this->auth->get_user_id();
        $this->table = 'comments';

        $this->moveToDB();
    }
/********************************************************************************/
    private function getComment() {
        $accidentid = $this->accidentid;
        $comment = $_POST['comment'];
        if (!empty($comment)) {
            $this->moveToDB($comment);
        }
    }
   /********************************************************************************/

    private function moveToDB() {
        $comment = $this->comment;
        $date = " ";
        $time = time();
        $userID = $this->userID;
        $commentData = array(
            'user_id' => $userID,
            'accident_id' => $this->accidentid,
            'message' => $comment,
            'comment_date' => $date,
            'comment_time' => $time
        );
        $this->CI->load->database();
        $this->CI->db->insert($this->table, $commentData);
    }
/********************************************************************************/


}

