<?php

// Created by Demetrious A. Cooper for Chemlabaccs Capstone Project 
// Created on 2/12/2014
// This class is responsible for handling photos that are to be upload during the submission of a accident report 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Photohandler {

    private $filepath;
    private $CI;
    private $imagepath;
    private $thumbpath;
    private $accidentid;
    private $userid;
    private $table = "";

    const DIR = "accident_photos/";
    const THUMBDIR = "accident_photos/thumbs/";

    public function __construct($params) {
   /****************************************************************************** */
        // Instantiate a new instance of CI and sets it to a class variable 

        $this->CI = & get_instance();
        $this->accidentid = $params['accidentid'];
        $this->userid = $params['userid' ];
        $this->table = "photos";
        /*         * **************************************************************************** */

        if(!empty($_FILES["filefield"]["name"][0]))
        return $this->createPhoto();


        // else throw error 
    }

    /* End of function __construct */
    /*     * ************************************************************************* */

    function isValid($photoext) {
        $validext = array("jpg", "jpeg", "gif", "png");

        if (in_array($photoext, $validext))
            return true;

        else
            return false;
    }

    /*     * ************************************************************************* */

    function validSize($size) {
        $checksize = 4200000;

        if ($size <= $checksize && !$size<=0) {
            return true;
        }

        else
            return false;
    }

    /*     * ************************************************************************* */

    function photopreview($photo) {

        return $photo;
        
        
    }
    
        /*************************************************************************** */

    function idGen($length) {
    if (empty($length)) {
        $length = 10;
    }
    $key = '';
    list($usec, $sec) = explode(' ', microtime());
    mt_srand((float) $sec + ((float) $usec * 100000));

    $inputs = array_merge(range(7, 8), range(0, 9), range(5, 6));

    for ($i = 0; $i < $length; $i++) {
        $key .= $inputs{mt_rand(0, 9)};
    }
    return $key;
}

    /*     * ************************************************************************* */
// Remember to use var chars since ints only go up to: 2147483647
    function movetoDB($photopath, $thumbpath,$comment) {
       
        $this->CI->load->helper('string');
        $photodata = array(
            'id'=> random_string('numeric', 7),
            'user_id' => $this->userid,
            'accident_id' => $this->accidentid,
            'photo_abs_url' => $photopath,
            'thumb_abs_url' => $thumbpath,
            'comment'=>$comment
                );
        $this->CI->load->database();
        $this->CI->db->insert($this->table, $photodata);
    }

    /*******************************************************************************/

    private function createPhoto() {
        $previewphotos = array();
        $size = count($_FILES['filefield']['name']);
        
        //if($size<0)
            
        for ($key = 0; $key < $size; $key++) {

            //$fname = $_FILES["filefield"]["name"][$key]; //chemlabaccs.timestamp
            $photoname = "chemlabaccs." . time();
           // $_FILES["filefield"]["name"][$key]=$photoname;
            $comment = "Some Comment Here...";
            $fsize = $_FILES["filefield"]["size"][$key];
            $temp_file = $_FILES["filefield"]["tmp_name"][$key];
            $fext = end(explode(".", $_FILES["filefield"]["name"][$key]));
            $fext = strtolower($fext);
            /*************************************************************** */
            // Preliminary Checks
            // 
            // Get the photo's extension

            if ($this->isValid($fext) && $this->validSize($fsize)) {
                // Do the work 
             
                    if($fext=="jpg" ||$fext== "jpeg")
                    {
                        $upload = $_FILES["filefield"]["tmp_name"][$key];
                        $uploadsrc = imagecreatefromjpeg($upload);
                    }

                   else if($fext=="png")
                    {
                        $upload = $_FILES["filefield"]["tmp_name"][$key];
                        $uploadsrc = imagecreatefrompng($upload);
                    }

                    else if($fext = "gif"){
                        $upload = $_FILES["filefield"]["tmp_name"][$key];
                        $uploadsrc = imagecreatefromgif($upload);
                    }
                    else
                        {
                        $ignore = true;
                       }
                } // End of Switch 1 
                //
                //
                // List the width and the height
                list($width, $height) = getimagesize($upload);
                $width_new = "640";

                //Keep the width and height in proportion
                if ($width > $width_new) {
                    $height_new = ($height / $width) * $width_new;
                    $temp_img = imagecreatetruecolor($width_new, $height_new);
                } 
                else {
                    $temp_img = imagecreatetruecolor($width, $height);
                    $height_new = $height;
                }

                /*                 * ******************************************************************************* */
                // Create our photo 
                imagecopyresampled($temp_img, $uploadsrc, 0, 0, 0, 0, $width_new, $height_new, $width, $height);

                /*                 * ******************************************************************************* */
                // Creation of Thumbnail Images
                $thumbheight = $thumbwidth = 250;
                $temp_thumb = imagecreatetruecolor($thumbwidth, $thumbheight);
                imagecopyresampled($temp_thumb, $uploadsrc, 0, 0, 0, 0, $thumbwidth, $thumbheight, $width, $height);


                //$photopath = "accident_photos/" . time() . $key . $_FILES['filefield']['name'][$key];
                $photopath = "accident_photos/" . time() . $key . "_".$photoname.".jpg";
                //$thumbpath = "accident_photos/thumbs/" . "thumb" . time() . $key . $_FILES['filefield']['name'][$key];
                 $thumbpath = "accident_photos/thumbs/" . "thumb_" . time() . $key ."_". $photoname.".jpg";

                 /************************************************************************************/
                imagejpeg($temp_img, $photopath, 100);
                imagejpeg($temp_thumb, $thumbpath, 100);
        
                imagedestroy($uploadsrc);
                imagedestroy($temp_img);
                imagedestroy($temp_thumb);

              
                // Move photo to DB
               // redirect($fext);
                if($temp_img)
                $this->movetoDB($photopath, $thumbpath,$comment);
                
            } // Enfo of for
            /*********************************************************************** */

            // If file size is too large, then resize using the image manipuation class
        }// End of Function Create Photo
        //$photo=  $CI->load->library('image_lib');
    

    /* ************************************************************************* */
        // This function is responsible for unlinking photo in the accident_photos and accident_photos/thumbs directory
        function unlinkphoto($photopath)
        {
            // Check if the image is the person who upload the image.
            // If the user isn't the author of the photo, then this function will return false.
            // This function is going to be accessed via an asychronous call.
            
            
            $accident_photos = '../../accident_photos/';
            chdir($accident_photos);
            $path= array_shift(explode('accident_photos/', $photopath));
            $rmphoto = unlink($path);
            
            if($rmphoto)
            {
                $accident_photos='thumbs/';
                chdir($accident_photos);
                $path=array_shift(explode('accident_photos/thumbs/', $photopath));
                unlink($path);
            }
        
            
        }
    /* ************************************************************************* */
        // This function is responsible for removing photos from the database. 
        function removefromdb($photoid)
        {
            $photodata = array('id'=>$photoid);
              $this->CI->db->delete($this->table,$photodata);


//$this->unlinkphoto($photopath)
            
        }
    /* ************************************************************************* */


}

/* End of  Class File */