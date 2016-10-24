<!--
Set the 'controller', 'task', and 'message' vars to their values before rendering this view.

The 'back' and 'backText' vars are optional, but recomended for usability.

Use 'posts' to transfer hidden post data such as ids and what not.
-->
<div id="wrapper">

<form action="<?php echo LOGIN_URL.'/'; ?>" method="post">
	<?php echo $vars->message; ?><br />

	<input type="hidden" name="task" value="<?php echo $vars->task; ?>" />
	<input type="hidden" name="controller" value="<?php echo $vars->controller; ?>" />
    <?php
        foreach($vars->posts as $name => $value) {
            echo '<input type="hidden" name="'.$name.'" value="'.$value.'" /><br/>';
        }
    ?>
	<input type="submit" name="ok" class="ok" value="OK" /> 
	<input type="submit" name="cancel" class="cancel" value="Annuller" /> 
</form>
<?php
	if(isset($vars->back)) {
		if(!isset($vars->backText) || length($vars->backText) == 0) {
			$vars->backText = 'Tilbage';
		}
		echo "<a href=\"" . $vars->back . "\"> " . $vars->backText . "</a>";
	}
?>
</div>