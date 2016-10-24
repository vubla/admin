<?

        $structure = nl2br(htmlentities($vars->structure));
?>
    
      <h1>Structure</h1> 
      <? //$structure = preg_replace('/\/\*(.*)\/;/','',$structure); ?>
   <? //$structure = preg_replace('/\-\-(.*)\n/','',$structure); ?>
   

   <? echo $structure;?>
  
