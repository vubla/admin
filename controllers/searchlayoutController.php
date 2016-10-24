<?php
//var_dump($_POST);
class searchlayoutController extends BaseController {

    function view(){
    
        $this->vars->host = $_POST['host'];
        $this->view = 'viewsearchlayout';
    }
    
       

}


?>