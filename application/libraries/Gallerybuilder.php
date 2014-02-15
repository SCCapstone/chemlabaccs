<?php

/*
 * The Gallery builder class returns a thumbnail gallery associated with a accident id
 * The accident Id is the only parameter needed to build a thumbnail gallery. 
 * @author Demetrious A. Cooper 2/13/2014
 */
class Gallerybuilder {

    private $CI;
    private $accidentid;

    const HTMl = '<div id = "photoview" class = "row">';

    public function __construct($params) {

        // We need to obtain the id of the accident @params  
        $this->CI = & get_instance();
        $this->accidentid = $params[0];
        $this->buildGallery();
    }

    /**************************************************************** */
    // This function can be used to get the number of photos associated with a given id 
    // and build different variatons of thumbnail galleries 
    function numImages() {
// query the database to see how many images matches the classes' accidentid 
        $this->CI->load->database();
        $sql = "SELECT * FROM photos WHERE accident_id='$this->accidentid'";
        $query = $this->CI->db->query($sql);
        $size = $query->num_rows();
        //$size = 1;
        return $size;
    }

    /************************************************************************/
   // This function gets the photos from the database associated with the provided accident id
    function getPhotos() {
        $this->CI->load->database();
        $sql = "SELECT * FROM photos WHERE accident_id='$this->accidentid'";
        $query = $this->CI->db->query($sql);
    
        
        return $query;
    }

    /*********************************************************************/
    // This is the final function in the Gallerybuilder class. This function outputs a thumbnail gallery with 200px X 200px 
    // thumbnails.  
    private function buildGallery() {
        $size = $this->numImages();
        $query = $this->getPhotos();
        $html = self::HTMl;
        $html.='<div class="">'; 
        $i = 0;
        foreach ($query->result() as $photo) {

            $html.='<img src=../../' . $photo->thumb_abs_url . ' class ="img-thumbnail" width="200px" height="200px" description="' . $photo->comment . '">';
            $i++;
        }
        $html.="</div></div>";

        echo $html;
        }

}

?>
