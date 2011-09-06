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

use app\models\AustralianStates;

/**
 * Manage the Australian States in the database
 */
class AustralianStatesController extends \lithium\action\Controller {

	/**
	 * list all of the states
	 */
    public function index() {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
        
        // get the list of categories
        $data = AustralianStates::all(array('order' => array('id' => 'ASC')));
        return compact('data');
    }
    
    /**
     * add a new category to the database
     */
    public function add() {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	// create a new category with the posted data
    	$data = AustralianStates::create($this->request->data);
    	
    	// check to see if data as send and the save was successful
    	if(($this->request->data) && $data->save()) {
    		// redirect back to the index page
    		Session::write('message', 'Success: New record created');
    		return $this->redirect('AustralianStates::index');
    	}
    	
    	// show the default category create form
    	return compact('data');
    	
    }
    
    /**
     * edit an existing category
     */
    public function edit($id = null) {
    
    	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
    	$id = (int)$id;
    	$data = AustralianStates::find($id);
    	
    	if(empty($data)) {
    		return $this->redirect('AustralianStates::index');
    	}
    	
    	if($this->request->data){
    		if($data->save($this->request->data)) {
    			Session::write('message', 'Success: Record updated');
    			return $this->redirect('AustralianStates::index');
    		} else {
    			Session::write('message', 'Error: An error occurred please try again.');
    			return $this->redirect('AustralianStates::index');
    		}
    	}
    	
    	return compact('data');
    }
    
    /**
     * delete an existing category
     */
    public function delete($id = null) {
    
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
        
        $id = (int)$id;
        
        AustralianStates::remove(array('id' => $id));
        Session::write('message', 'Success: Record deleted');
        return $this->redirect('AustralianStates::index');    
    }

}
?>