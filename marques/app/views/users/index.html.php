<?php
/**
 *  This file is part of MARQUes - Maps Answering Research Questions.
 *
 *  MARQUes is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  MARQUes is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with MARQUes.  If not, see <http://www.gnu.org/licenses/>.
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