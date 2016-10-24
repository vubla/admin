<?php


class testController extends BaseController {
        
        function standard() {
             $this->view = 'testoverview';
        }
        
        function jstest() {
            $jqueryfile = 'jquery-latest.js';
            if(isset($_GET) && isset($_GET['jqueryfile'])) {
                $jqueryfile = $_GET['jqueryfile'];
            }
            
            $testfile = 'general';
            if(isset($_GET) && isset($_GET['testfile'])) {
                $testfile = $_GET['testfile'];
            }
            
            $prototypefile = 'none';
            if(isset($_GET) && isset($_GET['prototypefile'])) {
                $prototypefile = $_GET['prototypefile'];
            }
            
            $wid = 6; // oscommerce test shop
            if(isset($_GET) && isset($_GET['wid'])) {
                $wid = $_GET['wid'];
            }
            
            $jQueryPath = 'http://code.jquery.com/';
            $prototypePath = 'https://ajax.googleapis.com/ajax/libs/prototype/';
            $qUnitPath = $jQueryPath.'qunit/git/';
            $testPath = '';
            $ourJsCodePath = API_URL.'/scripts/';
            
            if(!empty($prototypefile) && $prototypefile != 'none') {
                $this->addJs($prototypePath.$prototypefile);
                $protoTypeTest = file_get_contents(CLASS_FOLDER.'/tests/testjs/prototype_test.js');
                $this->addJs($protoTypeTest,true);
            }
            if(!empty($jqueryfile) && $jqueryfile != 'none') {
                $this->addJs($jQueryPath.$jqueryfile);
            }
            $this->addJs($qUnitPath.'qunit.js');
            $this->addJs($ourJsCodePath.'?id=magento_all_pages&wid='.$wid.'&test='.urlencode($testPath.$testfile));
            $this->addCss($qUnitPath.'qunit.css');
            //$this->addJs($tests,true);
            
            
            
            $this->layout = 'no_initial_js_'; //Otherwiase we load our own jquery.js etc. no matter what
            $this->view = 'jstest';
        }
}
