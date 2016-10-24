<?php

include ('views/dbstructureView.php');
?>

<h1>Confirm</h1>
    
<form method="post" action="<?php $this->link('database', 'updateconfirm'); ?>">
<input name="submit" value="Confirm" type="submit" />
<input name="task" value="update_confirm" type="hidden" />
<input name="query" value="<?=$vars->query?>" type="hidden" />

</form>

