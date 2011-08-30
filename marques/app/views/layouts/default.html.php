<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 *
 * Original Template Design by Jason Cole (http://jasoncole.ca/) and released into the Public Domain
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>MARQues > <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('marques')); ?>
	<?php echo $this->scripts(); ?>
</head>
<body>
	<div id="container">
		<div id="head">
			<h1>MARQues</h1>
			<!--
			<ul class="toplinks">
				<li><a href="index.html">Blue</a></li>
				<li><a href="index2.html">Red</a></li>
				<li><a href="index3.html">Orange</a></li>
				<li><a href="index4.html">Green</a></li>
				<li><a href="index5.html">Aqua</a></li>
				<li><a href="index6.html">Pink</a></li>
				<li><a href="index7.html">Purple</a></li>
			</ul>
			-->
		</div>
		<div id="body">
			<?php echo $this->content(); ?>
		</div>
		<div id="tail">
			<br />
			<p>Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.</p>
		</div>
	</div>
</body>
</html>