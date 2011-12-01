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
	
	$link_options = array(
		'class'  => 'external',
		'target' => 'blank'
	);

?>
<div class="fw-info-window-content">
<div style="float: left; clear: ">
<img style="float: left" src="<?=$markers[$cinema->film_weekly_cinema_types_id][$cinema->locality_types_id]; ?>"/>
</div>
<div>
<h1><?=$details['cinema_name']; ?></h1>
<h2><?=$details['exhibitor_name']; ?></h2>
<h3><?=$details['address'];?></h3>
</div>
<p>Film Weekly Listings: <?=$listings; ?></p>
<p>First Recorded Capacity: <?=$cinema->capacity; ?></p>
<h4>Venue Archaeology</h4>
<ul>
<?php foreach($cinema->film_weekly_archaeologies as $record) { ?>
	<?php if($record->cinema_name != null) { ?>
		<li><?=$categories[$record->film_weekly_categories_id]; ?> Cinema Name: <?=$record->cinema_name; ?></li>
	<?php }?>
	<?php if($record->exhibitor_name != null) { ?>
		<li><?=$categories[$record->film_weekly_categories_id]; ?> Exhibitor Name: <?=$record->exhibitor_name; ?></li>
	<?php }?>
	<?php if($record->capacity != null) { ?>
		<li><?=$categories[$record->film_weekly_categories_id]; ?> Capacity: <?=$record->capacity; ?></li>
	<?php }?>
<?php } ?>
</ul>
<h4>Resources</h4>
<ul>
<?php foreach($resources as $resource) { ?>
	<li><?=$this->html->link($resource['title'], $resource['url'], $link_options); ?></li>
<?php } ?>
</ul>
</div>