<?php


class databaseController extends BaseController {
        
        function standard(){
                
             $this->viewstructure();
        }
        
        function viewstructure(){
            $db = new WebshopDbManager();
            $this->vars->structure = $db->get_database_structure(); 
            $this->view = 'dbstructure';
        }
        
        function edit(){
             
            $vpdo = VPDO::getVdo(DB_METADATA);
            $stm = $vpdo->prepare("select query from query_log order by id desc limit 30");     
            $stm->execute();
            $this->vars->list = $stm->fetchAll();
            $stm->closeCursor();
           
            $this->view ='dbedit';

            
        }
        
        function  updateconfirm(){
            if(!isset($_POST)) return;
            $db = new WebshopDbManager();
            $query = $_POST['query'];
            $db->update($query, false);
            $this->redirect('database','viewstructure');
        }
        
        function update(){
            $db = new WebshopDbManager();
            $this->vars->query = $_POST['query'];
            $this->vars->errors = $db->update($this->vars->query, true);
            if($this->vars->errors != null){
                $this->view = 'dbedit';
                return;
            }
            
            $this->vars->structure = $db->temp_structure;    
            $this->view = 'dbconfirmedit';
        
        }
        
        
        
}
 
        
?>
    