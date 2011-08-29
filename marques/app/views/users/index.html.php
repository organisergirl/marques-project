<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * List information about users 
  */
?>

<h2>Users</h2>
<table>
	<thead>
		<tr>
			<th>User Name</th><th>Full Name</th><th>Email Address</th><th>Edit</th><th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) {?>
			<tr>
				<td><?=$user->username; ?></td>
				<td><?=$user->name(); ?></td>
				<td><?=$this->marquesHtml->mailto($user->email); ?></td>
				<td>Edit Link</td>
				<?php if($user->username != "admin") { ?>
					<td>Delete link</td>
				<?php } else { ?>
					<td>&nbsp;</td>
				<?php } ?>
			</tr>
		<?php } ?>
	</tbody>
</table>