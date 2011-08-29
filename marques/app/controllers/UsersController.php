<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\controllers;

use lithium\security\Auth;
use app\models\Users;

/**
 * Manage the users in the database
 */
class UsersController extends \lithium\action\Controller {

	
	/**
	 * find all of the users for the default index page
	 */
    public function index() {
    
    	// check to confirm the user is logged in
    	// only do this *after* the first user is created
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
        
    	// sort the list of users by user name
    	$users = Users::all(array('order' => array('username' => 'ASC')));
    	return compact('users');
    }

	/**
	 * add a new user to the database
	 */
    public function add() {
    	    
    	// check to confirm the user is logged in
    	// only do this *after* the first user is created
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
    
    	// create a new user with the posted data
        $user = Users::create($this->request->data);

		// check to see if stuff was sent and the save was successful
        if (($this->request->data) && $user->save()) {
        	// redirect back to the main user page
            return $this->redirect('Users::index');
        }
        
        // show the default user creation form
        return compact('user');
    }
    
    /**
     * delete / remove a user by id
     */
    public function delete() {
    
       	// check to confirm the user is logged in
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        }
    
		$user = $this->request->id;
		
		if(!empty($user)) {
		
			// check to ensure we're not trying to delete the admin user
    		if($user != "admin") {
    			// delete the specified user and go back to the user list page
    			Users::remove(array("username" => $user));
            	return $this->redirect('Users::index');
    		} else {
    			// show some sort of error
    		}
		} else {
			// show some sort of error
		}
		
		    
/*
    	$path = func_get_args();
    	
    	if(count($path) != 1) {
    		// show some sort of error
    		
    	} else {
    	
    		// check to ensure we're not trying to delete the admin user
    		if($path[0] != "admin") {
    			// delete the specified user and go back to the user list page
    			Users::remove(array("username" => $path[0]));
            	return $this->redirect('Users::index');
    		} else {
    			// show some sort of error
    		}
    	}
*/
    	
    } 
    
    /**
     * edit a user record
     */
    public function edit($id = null) {
    
    	$id = (int)$id;
    	$user = Users::find($id);
    	
    	if(empty($user)) {
    		return $this->redirect('Users::index');
    	}
    	
    	if($this->request->data){
    		if($user->save($this->request->data)) {
    			return $this->redirect('Users::index');
    		}
    	}
    	
    	return compact('user');
    }
}

?>