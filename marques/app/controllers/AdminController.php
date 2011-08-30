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

/**
 * central spot for admin tasks
 */
class AdminController extends \lithium\action\Controller {

	/**
	 * display the start admin page
	 */
    public function index() {
    
    	// check to confirm the user is logged in
    	// only do this *after* the first user is created
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
        } 
        
    	
    }


}