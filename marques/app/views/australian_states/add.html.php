<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * Collect information about a new Australian State 
  */
?>
<?php $this->title('Create New Australian State'); ?>

<h2>Create New Australian State</h2>
<?=$this->form->create($data); ?>
	<?=$this->form->field('id', array('label' => 'Unique ID Number')); ?>
	<?=$this->form->field('shortname', array('label' => 'State Abbreviation')); ?>
	<?=$this->form->field('longname', array('label' => 'State Full Name')); ?>
	<?=$this->form->submit('Create New Record'); ?>
<?=$this->form->end(); ?>