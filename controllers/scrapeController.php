<?php


class scrapeController extends BaseController {

    function index(){
        $this->vars = new stdclass();
        $this->vars->called = '';
        $this->vars->result = '';
        $this->view = 'scrapeindex';
        if(isset($_GET['called']))
        {
            $this->vars->called = $_GET['called'];
            $this->vars->result = file_get_contents('http://localhost:9001/'.$this->vars->called);
        }
    }



}

