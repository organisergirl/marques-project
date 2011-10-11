<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use lithium\security\Auth;
use lithium\storage\Session;
use li3_flash\extensions\storage\Flash;

use app\models\FilmWeeklyMarkers;
use app\models\FilmWeeklyCinemaTypes;
use app\models\LocalityTypes;

/**
 * manage the film weekly markers records in the database
 */
class FilmWeeklyMarkersController extends \lithium\action\Controller {

	/**
	 * list the existing marker records
	 */
	public function index() {
	
		$markers = FilmWeeklyMarkers::all(
		array (
				'with' => array(
					'FilmWeeklyCinemaTypes',
					'LocalityTypes'
				)
			)
		);
		
		$this->set(compact('markers'));
	}
	
	/**
	 * add a new marker record
	 */
	public function add() {
	
		if(!$this->request->data) {
        	
        	// build an empty form	
        	$marker = FilmWeeklyMarkers::create();
        	
        	$records = FilmWeeklyCinemaTypes::all();
        	$cinema_types = array();
        	
        	foreach($records as $record) {
        		$cinema_types[$record->id] = $record->description;
        	}
        	
        	$records = LocalityTypes::all();
        	$locality_types = array();
        	
        	foreach($records as $record) {
        		$locality_types[$record->id] = $record->description;
        	}
        	
			$this->set(compact('marker', 'cinema_types', 'locality_types'));
			
		} else {
		
			$marker = FilmWeeklyMarkers::create($this->request->data);
        	
        	if($marker->save()) {				
				// redirect back to the index page
	    		Flash::write('Success: Record created');
	    		return $this->redirect(array('FilmWeeklyMarkers::index'));
			} else {
				// get the rest of the form data and show errors
        		$records = FilmWeeklyCinemaTypes::all();
	        	$cinema_types = array();
	        	
	        	foreach($records as $record) {
	        		$cinema_types[$record->id] = $record->description;
	        	}
	        	
	        	$records = LocalityTypes::all();
	        	$locality_types = array();
	        	
	        	foreach($records as $record) {
	        		$locality_types[$record->id] = $record->description;
	        	}
	        	
	        	$this->set(compact('marker', 'cinema_types', 'locality_types'));
			}
		}
	}
	
	public function delete($id = null) {
        
        $id = (int)$id;
        
        FilmWeeklyMarkers::remove(array('id' => $id));
        Flash::write('Success: Record deleted');
        
        return $this->redirect(array('FilmWeeklyMarkers::index'));
	}
}
?>