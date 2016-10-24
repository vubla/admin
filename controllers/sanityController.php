<?php

class sanityController extends BaseController {

    function standard() {
        $this->redirect('sanity','index'); 
    }

    function index() {
        $this->vars->result = 'OK';
        $this->vars->error = array(); 
        $this->view = 'user';
        
        
        $sql = 'select id from  webshop';
        $wids = vdo::meta()->fetchSingleArray($sql);
        
        foreach ($wids as $wid) {
            $sql = 'select * from  crawllist l where wid = ?';
            $crawl = vdo::meta()->fetchRow($sql,$wid);
            
            $beingcrawled = $crawl->currentlybeingcrawled;
            $lastCrawl = $crawl->last_crawled;
            $lastUpdated = $crawl->last_updated;
        }
    }
}
