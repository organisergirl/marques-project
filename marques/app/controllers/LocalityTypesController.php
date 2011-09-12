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

use app\models\LocalityTypes;

/**
 * Manage the Film Weekly Categories in the database
 */
class LocalityTypesController extends \lithium\action\Controller {

	/**
	 * list all of the records
	 */
    public function index() {
        
        // get the list of records
        $data = LocalityTypes::all(array('order' => array('id' => 'ASC')));
        return compact('data');
    }
    
    /**
     * add a new record
     */
    public function add() {
    
    	// create a new record with the posted data
    	$data = LocalityTypes::create($this->request->data);
    	
    	// check to see if data as send and the save was successful
    	if(($this->request->data) && $data->save()) {
    		// redirect back to the index page
    		Session::write('message', 'Success: Record created');
    		return $this->redirect('LocalityTypes::index');
    	}
    	
    	// show the default category create form
    	return compact('data');
    	
    }
    
    /**
     * edit an existing record
     */
    public function edit($id = null) {
    
    	$id = (int)$id;
    	$data = LocalityTypes::find($id);
    	
    	if(empty($data)) {
    		return $this->redirect('LocalityTypes::index');
    	}
    	
    	if($this->request->data){
    		if($data->save($this->request->data)) {
    			Session::write('message', 'Success: Record updated');
    			return $this->redirect('LocalityTypes::index');
    		} else {
    			Session::write('message', 'Error: An error occurred please try again.');
    			return $this->redirect('LocalityTypes::index');
    		}
    	}
    	
    	return compact('data');
    }
    
    /**
     * delete an existing record
     */
    public function delete($id = null) {
        
        $id = (int)$id;
        
        LocalityTypes::remove(array('id' => $id));
        Session::write('message', 'Success: Record deleted');
        return $this->redirect('LocalityTypes::index');    
    }
}
?>