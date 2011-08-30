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

use app\models\BasicMarkers;

/**
 * Manage the basic markers in the database
 */
class BasicMarkersController extends \lithium\action\Controller {

	
	/**
	 * find all of the users for the default index page
	 */
    public function index() {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
        
    	// sort the list of markers by title
    	$markers = BasicMarkers::all(array('order' => array('title' => 'ASC')));
    	return compact('markers');
    }

	/**
	 * add a new user to the database
	 */
    public function add() {
    	    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	// create a new user with the posted data
        $marker = BasicMarkers::create($this->request->data);

		// check to see if stuff was sent and the save was successful
        if (($this->request->data) && $marker->save()) {
        	// redirect back to the main basic marker page
        	Session::write('message', 'Success: Marker successfully added');
            return $this->redirect('BasicMarkers::index');
        }
        
        // show the default marker creation form
       return compact('marker');
    }
    
    /**
     * delete / remove a user
     */
    public function delete($id = null) {
    
       	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
        
        $id = (int)$id;
        
        BasicMarkers::remove(array("id" => $id));
        Session::write('message', 'Success: Marker successfully deleted');
        return $this->redirect('BasicMarkers::index');
    } 
    
    /**
     * edit a basic marker record
     */
    public function edit($id = null) {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	$id = (int)$id;
    	$marker = BasicMarkers::find($id);
    	
    	if(empty($marker)) {
    		return $this->redirect('BasicMarkers::index');
    	}
    	
    	if($this->request->data){
    		if($marker->save($this->request->data)) {
    			Session::write('message', 'Success: Marker successfully updated');
    			return $this->redirect('BasicMarkers::index');
    		} else {
    			Session::write('message', 'Error: An error occurred please try again.');
    			return $this->redirect('BasicMarkers::index');
    		}
    	}
    	
    	return compact('marker');
    }
}

?>