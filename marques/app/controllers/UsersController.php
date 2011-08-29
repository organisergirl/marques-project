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
}

?>