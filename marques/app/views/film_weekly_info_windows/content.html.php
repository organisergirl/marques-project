<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * Build the Film Weekly Info Window 
  */
?>
<?php

	$details = $cinema->search_result();

?>
<div class="fw-info-window-content">
<h1><?=$details['cinema_name']; ?></h1>
<h2><?=$details['exhibitor_name']; ?></h2>
<h3><?=$details['address'];?></h3>
<p>&nbsp;<span style="float: left">Capacity: <?=$cinema->capacity; ?></span><span style="float:right">Film Weekly Listings: <?=$listings; ?></span></p>
<h4>Venue Archaeology</h4>
<?php foreach($cinema->film_weekly_archaeologies as $record) { ?>
	<?php if($record->cinema_name != null) { ?>
		<p><?=$categories[$record->film_weekly_categories_id]; ?> Cinema Name: <?=$record->cinema_name; ?></p>
	<?php }?>
	<?php if($record->exhibitor_name != null) { ?>
		<p><?=$categories[$record->film_weekly_categories_id]; ?> Exhibitor Name: <?=$record->exhibitor_name; ?></p>
	<?php }?>
	<?php if($record->capacity != null) { ?>
		<p><?=$categories[$record->film_weekly_categories_id]; ?> Capacity: <?=$record->capacity; ?></p>
	<?php }?>
<?php } ?>
<h4>Resources</h4>
</div>