<!DOCTYPE html>

<html>

<head>

	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<title><?php

	if (isset($title)){

		echo $title;

	} 

	?></title>

	<?php

	if (strtolower($this->params['controller']) === 'transjuals' && strtolower($this->params['action']) === 'index'||
		strtolower($this->params['controller']) === 'notajuals' && strtolower($this->params['action']) === 'index'||
		strtolower($this->params['controller']) === 'notajuals' && strtolower($this->params['action']) === 'detil') {

	?>
	<input style="display:none;" id="printer" type="text" value="ulfa" size="15">
	<script type="text/javascript" src="<?php echo $this->Html->url(array('controller'=>'transjuals','action'=>'jzebra', 'deployJava.js')); ?>"></script> 

	<script type="text/javascript">

		<?php echo $this->element('printer'); ?>

	</script>	

	<?php } ?>


	<?php echo $this->Html->script('jquery');?>

	<?php echo $this->Html->script('index');?>

	<?php echo $this->Html->script('jquery-ui-1.10.4.custom.min'); ?>

	<?php echo $this->Html->script('jquery.hotkeys'); ?>

	

	<?php echo $this->Html->script('bootstrap.min'); ?>


	<?php

	echo $this->Html->script(array( 'jquery.autocomplete.min' ));	

	?>
	<?php echo $this->Html->css(array('cake.generic.css','bootstrap.min.css','jquery-ui-1.10.4.custom.min.css','me.css')); ?>

</head>

<body>

	



	<div id="wrap" style="padding-top:5%;">

		

	<?php echo $this->element('navbar', array('menu'=> strtolower($this->params['controller'])) ); ?> 

		

		<div class="container">

			<?php 

		if (strpos($this->request->url, 'main') === false && strpos($this->request->url, 'transjuals') === false &&

	  		$this->request->here !== $this->request->base . '/') 

				echo $this->Html->getCrumbs(' > ', 'Home'); 

	?>

		<?php



		echo $this->Session->flash();

		echo $this->fetch('content');

		?>

		</div>

		

		<?php

		echo $this->element('footer');

		?>

	</div>

	
	

	

	<script type="text/javascript">

	$(document).ready(function(){

	<?php echo $this->element('jsmain'); ?>

	<?php echo $this->element('jstransjual'); ?>

	<?php echo $this->element('jsnotajual'); ?>

	<?php echo $this->element('jsitemtoko'); ?>

	<?php echo $this->element('jsitemrusak'); ?>

	<?php echo $this->element('jsgudang'); ?>

	<?php echo $this->element('jsdaftarkirim'); ?>

	<?php echo $this->element('jsretur'); ?>

	});

	</script>

	<?php echo $scripts_for_layout; ?>

	<!-- Js writeBuffer -->

	<?php

	if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) echo $this->Js->writeBuffer();

	// Writes cached scripts

	?>

</body>

</html>