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

use app\models\FilmWeeklyCinemaTypes;

/**
 * Manage the Film Weekly Cinema Types in the database
 */
class FilmWeeklyCinemaTypesController extends \lithium\action\Controller {

	/**
	 * list all of the records
	 */
    public function index() {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
        
        // get the list of records
        $data = FilmWeeklyCinemaTypes::all(array('order' => array('id' => 'ASC')));
        return compact('data');
    }
    
    /**
     * add a new record to the database
     */
    public function add() {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	// create a new record with the posted data
    	$data = FilmWeeklyCinemaTypes::create($this->request->data);
    	
    	// check to see if data was sent and the save was successful
    	if(($this->request->data) && $data->save()) {
    		// redirect back to the index page
    		Session::write('message', 'Success: Record created');
    		return $this->redirect('FilmWeeklyCinemaTypes::index');
    	}
    	
    	// show the default create form
    	return compact('data');
    	
    }
    
    /**
     * edit an existing record
     */
    public function edit($id = null) {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	$id = (int)$id;
    	$data = FilmWeeklyCinemaTypes::find($id);
    	
    	if(empty($data)) {
    		return $this->redirect('FilmWeeklyCinemaTypes::index');
    	}
    	
    	if($this->request->data){
    		if($data->save($this->request->data)) {
    			Session::write('message', 'Success: Record updated');
    			return $this->redirect('FilmWeeklyCinemaTypes::index');
    		} else {
    			Session::write('message', 'Error: An error occurred please try again.');
    			return $this->redirect('FilmWeeklyCinemaTypes::index');
    		}
    	}
    	
    	return compact('data');
    }
    
    /**
     * delete an existing record
     */
    public function delete($id = null) {
    
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
        
        $id = (int)$id;
        
        FilmWeeklyCinemaTypes::remove(array('id' => $id));
        Session::write('message', 'Success: Record deleted');
        return $this->redirect('FilmWeeklyCinemaTypes::index');    
    }
}
?>