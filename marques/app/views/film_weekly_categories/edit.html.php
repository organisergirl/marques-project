<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * edit information about an existing user 
  */
?>

<h2>Edit Existing Category</h2>
<?=$this->form->create($category); ?>
	<?=$this->form->hidden('edit', array('value' => 'true'))?>
	<?=$this->form->field('id', array('label' => 'Unique ID Number')); ?>
	<?=$this->form->field('description', array('label' => 'Category Description')); ?>
	<?=$this->form->submit('Update Category'); ?>
<?=$this->form->end(); ?>