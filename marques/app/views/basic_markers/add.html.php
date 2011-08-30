<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * collect information about a new basic marker 
  */
?>
<?php $this->title('Add New Basic Marker'); ?>

<h2>Add New Basic Marker</h2>
<?=$this->form->create($marker); ?>
	<?=$this->form->field('title', array('label' => 'Marker Title')); ?>
	<?=$this->form->field('description', array('label' => 'Marker Description')); ?>
	<?=$this->form->field('latitude', array('label' => 'Latitude Geo-Coordinate')); ?>
	<?=$this->form->field('longitude', array('label' => 'Longitude Geo-Coordinate')); ?>
	<?=$this->form->submit('Create New Marker'); ?>
<?=$this->form->end(); ?>