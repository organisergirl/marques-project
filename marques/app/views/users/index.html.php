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

    <ul>
        <?php foreach ($users as $user) { ?>
            <li><?=$user->username; ?></li>
        <?php } ?>
    </ul>