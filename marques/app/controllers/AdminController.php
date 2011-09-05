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

use app\models\Users;

/**
 * central spot for admin tasks
 */
class AdminController extends \lithium\action\Controller {

	/**
	 * display the start admin page
	 */
    public function index() {
    
    	// check to confirm the user is logged in_array
    	$auth_user = Auth::check('default');
    	
    	if (!$auth_user) {
            return $this->redirect('Sessions::add');
        }
        
        // get a count of the number of users
        $user_count = Users::find("count");
        
        $data = array('user_count' => $user_count, 'auth_user' => $auth_user);
        return compact('data');
    }

}
?>