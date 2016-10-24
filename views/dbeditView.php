
<h1>Query Editor</h1> 
<pre>
<?php if($vars->errors){
    var_dump($vars->errors);
    
}
?>
</pre>
<form action="<?php $this->link('database','update'); ?>" method="post"> 

<textarea name="query" cols="100" rows="20"><? if(isset($vars->query)) { echo $vars->query; } else { echo "Indtast query her...."; } ?></textarea>
<input type="hidden" name="task" value="update" />
<input type="submit" value="Update" name="submit" />
</form>
    <table>
       <?php
       foreach ($vars->list as $key => $value) {
           echo '<tr>';
           
           
                echo '<td><pre>'.base64_decode($value[0]).'</pre><hr></td>';   
           
           
           echo '</tr>';
       }
       
       
       ?>
       
       
       </table>
      
