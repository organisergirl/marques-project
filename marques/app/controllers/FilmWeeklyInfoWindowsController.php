<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use app\models\FilmWeeklyCinemas;
use app\models\FilmWeeklyArchaeology;

/**
 * manage the film weekly markers records in the database
 */
class FilmWeeklyInfoWindowsController extends \lithium\action\Controller {

	// list actions that can be undertaken without authentication
	public $publicActions = array('index');
    
    /**
     * method to get the contents of the infoWindow
     */
    public function index($id = null) {
    
    	$id = (int)$id;
    	
    	$cinema = FilmWeeklyCinemas::find(
			'first',
			array(
				'with' => 'AustralianStates',
				'conditions' => array('FilmWeeklyCinemas.id' => $id)
			)
		);
		
		$archaeologies = FilmWeeklyArchaeology::find($id);
		
		
		// change to the infoWindow layout
		$this->_render['layout'] = 'fw_info_window';
		return compact('cinema', 'archaeologies');
    }
}
?>