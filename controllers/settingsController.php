<?php

class settingsController extends BaseController {
    function language() {
        $this->view='setDesc';
       
        if(isset($_POST['submitSettingsLang'])){
            settings::setDescAndLongForAll($_POST);
        }
         $this->vars->list = Settings::getAllWithAllDescriptions();
    }
   
}

?>