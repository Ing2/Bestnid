<?php $view->extend('index.html.php') ?>
<head>
<title><?php $view['slots']->output('title', 'daksdlkjsadkla') ?></title>
<?php $view['slots']->output('meta') ?>
<?php $view['slots']->output('stylesheets') ?>
<?php $view['slots']->output('javascripts') ?>
</head>
<body>
	<div class="header">
	   <?php $view['slots']->output('header') ?>
   </div> 

  <div class="main">
  <?php $view['slots']->output('main') ?>
    </div>
   <div class="footer">
  <?php $view['slots']->output('footer') ?>
    </div>
<?php $view['slots']->output('final') ?>
</body>
</html>
