<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
 /**
  * Search for Film Weekly Cinemas 
  */
?>
<?php $this->title('Search Film Weekly Cinemas'); ?>
<h2>Search for Film Weekly Cinemas</h2>
<?=$this->form->create(null); ?>
    <?=$this->form->field('search', array('value' => $search)); ?>
    <?=$this->form->submit('Search'); ?>
<?=$this->form->end(); ?>
<?php if(!empty($records)) { ?>
	<h2>Search Results</h2>
	<?php foreach($records as $record) {
		echo("<p> {$record->search_result()}</p>");
/*
		echo('<pre>');
		print_r($record);
		echo('</pre>');
*/
	} ?>
<?php } ?>
	
<!--
<?php
	if(!empty($records)) {
	echo('<pre>');
	print_r($records);
	echo('</pre>');
	}
?>

<?php
	if(!empty($cinemas)) {
	echo('<pre>');
	print_r($cinemas);
	echo('</pre>');
	}
?>
-->