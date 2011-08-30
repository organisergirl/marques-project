<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * List information about basic markers 
  */
?>
<?php $this->title('List of Basic Markers'); ?>
<h2>List of Basic Markers</h2>
<table>
	<thead>
		<tr>
			<th>Title</th><th>Description</th><th>Latitude</th><th>Longitude</th><th>Edit</th><th>Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($markers as $marker) {?>
			<tr>
				<td><?=$marker->title; ?></td>
				<td><?=$marker->description; ?></td>
				<td><?=$marker->latitude; ?></td>
				<td><?=$marker->longitude; ?></td>
				<td><?=$this->html->link("Edit", array("BasicMarkers::edit", "args" => $marker->id)); ?></td>
				<td><?=$this->html->link("Delete", array("BasicMarkers::delete", "args" => $marker->id)); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<?=$this->html->link("Add New Marker", array("BasicMarkers::add")); ?>