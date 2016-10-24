

<?php header("Content-type: application/x-javascript"); ?>

	$(function() {
		$( "#progressbar" ).progressbar({
			value: <?php echo $_GET['val'] ?>
		});
	});
