<?php
/**
 * The Comment Handler class is responsible for inserting, displaying, and removing comments from the Chemlabaccs Application
 * Modified by D.Cooper 4/17/2014
 */
class CommentHandler {

    private $CI;
    private $accidentid;
    private $userID;
    private $table = "";
    private $comment;

  /********************************************************************************/
    public function __construct($params) {
        $this->table = 'comments';
        $this->CI = &get_instance();

        if($params['action']=='post'){
        $this->accidentid = $params['accidentid'];
        $this->userID=$params['userid'];
        $this->comment = $params['comment'];
        //$params['commentid'];
        //$this->$userID = $this->auth->get_user_id();
        $this->moveToDB();
        }
        
        if($params['action']=='delete'){
          
       return  $this->deleteComment($params['theuser'],$params['commentid']);  
        
        }

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
    function deleteComment($user,$commentid) {
         $this->CI->load->database();
        $sql = "DELETE FROM comments WHERE user_id=$user && id=$commentid";
        $query = $this->CI->db->query($sql);
        if ($query) echo "Successful";
    }
    
    /********************************************************************************/



}

