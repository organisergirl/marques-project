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
<h3>Manage Users</h3>
<ul>
	<li>Registered Users: <?=$data["user_count"];?></li>
	<li><?=$this->html->link("List Users", array("Users::index")); ?></li>
	<li><?=$this->html->link("Add New User", array("Users::add")); ?></li>
</ul>