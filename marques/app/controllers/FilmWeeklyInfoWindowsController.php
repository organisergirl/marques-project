<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use app\models\FilmWeeklyCinemas;
use app\models\AustralianStates;
use app\models\FilmWeeklyCinemaTypes;
use app\models\LocalityTypes;
use app\models\FilmWeeklyCategoryMaps;
use app\models\FilmWeeklyArchaeology;
use app\models\FilmWeeklyCategories;

/**
 * Manage the Film Weekly Cinemas in the database
 */
class FilmWeeklyInfoWindowsController extends \lithium\action\Controller {

	// list actions that can be undertaken without authentication
	public $publicActions = array('content');
	
/*
	// enable content negotiation so AJAX data can be returned
	protected function _init() {
        $this->_render['negotiate'] = true;
        parent::_init();
    }
*/

	/**
	 * build the content of an infoWindow for a Film Weekly Marker
	 */
    public function content($id = null) {
    
    	// make sure the id is an integer
    	$id = (int)$id;
    
    	// find the cinema
    	$cinema = FilmWeeklyCinemas::find(
			'first',
			array(
				'with' => array('AustralianStates', 'FilmWeeklyArchaeology'),
				'conditions' => array('FilmWeeklyCinemas.id' => $id)
			)
		);
		
		$categories = $this->get_film_weekly_categories();
		
		$listings = $this->get_film_weekly_listings($id, $categories);
		
		$this->_render['layout'] = 'plain_text';
		return compact('cinema', 'categories', 'maps', 'listings');
    
    }
    
    // private function to get a list of film weekly categories
    private function get_film_weekly_categories() {
    
    	$categories = FilmWeeklyCategories::all();
    	
    	$records = array();
    	
    	foreach($categories as $category) {
    		
    		$records[$category->id] = $category->description;
    	}
    	
    	return $records;
    }
    
    // private function to get the film weekly listings range
    private function get_film_weekly_listings($id, $categories) {
    
    	$maps = FilmWeeklyCategoryMaps::all(
			array(
				'conditions' => array('film_weekly_cinemas_id' => $id)
			)
		);
		
		$min = null;
		$max = null;
		
		foreach($maps as $map) {
		
			if($min == null) {
				$min = $map->film_weekly_categories_id;
			}
			
			$max = $map->film_weekly_categories_id;
		}
		
		$min = $categories[$min];
		$max = $categories[$max];
		
		$min = explode('/', $min);
		$min = $min[0];
		
		$max = explode('/', $max);
		$max = '19' . $max[1];
		
		return $min . ' - ' . $max;
    
    }
}
?>