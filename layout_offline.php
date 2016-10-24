<?php 
	if($this->view == 'views/registerView.php') {
		include(VUBLA_BASE_PATH . '/header.php');
		include($this->view);
		include(VUBLA_BASE_PATH . '/footer.php');
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Vubla</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/core.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/login.css" type="text/css" />
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans" type="text/css">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" type="text/css">
	</head>

	<body>
		<?php include($this->view); ?>
	</body>
</html>
<?php
	}
?>