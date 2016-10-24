
<h1>Soap Tryout</h1> 
<pre>

</pre>
<form action="<?php $this->link('webshop','soap'); ?>" method="get"> 
Func: <input type="text" name="function" value="<?php echo @$_GET['function']; ?>" />
Arg1: <input type="text" name="arg1" value="<?php echo @$_GET['arg1']; ?>" />
Arg2: <input type="text" name="arg2" value="<?php echo @$_GET['arg2']; ?>" />
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
<input type="submit" value="Go" name="submit" />
</form>
    <pre>
       
       <?php 
       //echo "is discount: ";var_dump(MagentoFetcher::is_in_discount_periode($vars->result));
       if($vars->error){
    	var_dump($vars->error);
	}

       var_dump($vars->result);
       ?>
       
       
       </pre>
      <?
      
      
      
