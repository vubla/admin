<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Vubla</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/core.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo LOGIN_URL ?>/stylesheets/controlpanel.css" type="text/css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans" type="text/css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" type="text/css">
		<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo LOGIN_URL ?>/js/excanvas.min.js"></script><![endif]-->
		<script src="<?php echo LOGIN_URL ?>/js/jquery.js" type="text/javascript"></script>
		<script src="<?php echo LOGIN_URL ?>/js/jquery.flot.js" type="text/javascript"></script>
		<!--<script src="<?php echo LOGIN_URL ?>/js/jquery.flot.text.js" type="text/javascript"></script>-->
		<?php foreach($js as $link){ ?>
		  <script type="text/javascript" src="<?php echo $link; ?>"></script>  
		<?php } ?>
		<?php foreach($css as $link){ ?>
		  <link rel="stylesheet" href="<?php echo $link; ?>" type="text/css"> 
		<?php } ?>
        <?php foreach($javascript as $code){ ?>
          <script type="text/javascript"><?php echo $code; ?></script>  
        <?php } ?>
	</head>
	<body>
		<!--<a id="feedback" href="http://www.vubla.dk/kontakt/" target="_blank">Feedback</a>-->
		<div id="wrapper">
			<div id="header">
				<div id="logo">
					<img src="<?php echo LOGIN_URL ?>/images/logo_dark.png" alt="Vubla admin panel" />
				</div>
				<div id="nav">
					
					<a href="<?php $this->link(); ?>">Hjem</a>
				    <a href="<?php $this->link('searchlayout', 'view'); ?>">Prøv Vubla</a>
					<a href="<?php $this->link('default', 'tools'); ?>">Andre Værketøjer</a>
					<a href="<?php $this->link('user', 'index'); ?>">Users</a>
					<a href="<?php $this->link('database', 'standard'); ?>">DB view</a>
				    <a href="<?php $this->link('database', 'edit'); ?>">DB edit</a>
                    <a href="<?php $this->link('test', 'standard'); ?>">Test</a>
				</div>
				
				
			</div>
			
			<div id="content">
				<?php include($this->view); ?>
			</div>
		</div>
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
	</body>
</html>