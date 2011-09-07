<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * default admin page
  */
?>
<?php $this->title('Control Panel'); ?>
<h2>MARQues Control Panel</h2>
<p>Welcome: <?=$data['auth_user']['firstname'] . ' ' . $data['auth_user']['lastname']?></p>
<div>
	<div id="left-panel">
		<h3>Manage Users</h3>
		<ul>
			<li><?=$this->html->link('List Users', array('Users::index')); ?></li>
			<li><?=$this->html->link('Add New User', array('Users::add')); ?></li>
		</ul>
		<h3>Manage Film Weekly Data</h3>
		<ul>
			<li><?=$this->html->link('Manage Cinema Records', array('FilmWeeklyCinemas::index')); ?></li>
			<li><?=$this->html->link('Manage Australian States', array('AustralianStates::index')); ?></li>
			<li><?=$this->html->link('Manage Locality Types', array('LocalityTypes::index')); ?></li>
			<li><?=$this->html->link('Manage Categories', array('FilmWeeklyCategories::index')); ?></li>
			<li><?=$this->html->link('Manage Cinema Types', array('FilmWeeklyCinemaTypes::index')); ?></li>
		</ul>
	</div>
	<div id="right-panel">
		<h3>Site Statistics</h3>
		<ul>
			<li>Registered Users: <?=$data['user_count']; ?></li>
			<li>Film Weekly Cinemas: <?=$data['fw_cinema_count']; ?></li>
		</ul>
	</div>
</div>