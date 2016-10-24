



<h1>Scraper Interface</h1> 
<pre>

</pre>
<form action="<?php $this->link('scrape','index'); ?>" method="get"> 
Func: <input type="text" name="called" value="<?php echo $vars->called; ?>" />
<input type="submit" value="Go" name="submit" />
</form>
      <br /> 
       <?php 
       echo($vars->result);
       echo '<br/> <br/><pre>';
       echo(htmlentities(file_get_contents('http://localhost:9001/application.wadl'))); 
       echo '</pre>';
