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
<?php $this->title('List of Film Weekly Categories'); ?>
<h2>List of Film Weekly Categories</h2>
<p>
	List of categories for the cinema:<br/>
	<?=$data['cinema']->cinema_name; ?>
</p>
<ul>
	<?php foreach($data['categories'] as $category) { ?>
		<li>
			<?=$category->film_weekly_category->description; ?>
		</li>
	<?php } ?>
</ul>
<?=$this->html->link('Link to Another Category', array('FilmWeeklyCategoryMaps::add', 'args' => $data['cinema']->id)); ?>