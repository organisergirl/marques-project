<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * Create new record
  */
?>
<?php $this->title('Create New Locality Type'); ?>

<h2>Create New Locality Type</h2>
<?=$this->form->create($data); ?>
	<?=$this->form->field('id', array('label' => 'Unique ID Number')); ?>
	<?=$this->form->field('description', array('label' => 'Locality Type Description')); ?>
	<?=$this->form->submit('Create New Record'); ?>
<?=$this->form->end(); ?>