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

    public function index() {
    
    	// check to confirm the user is logged in
    	// only do this *after* the first user is created
    	if (!Auth::check('default')) {
            return $this->redirect('Sessions::add');
            //return $this->redirect('https://marques.local/marques/login');
        } else {
        	$users = Users::all();
        	return compact('users');
        }
    }

    public function add() {
        $user = Users::create($this->request->data);

        if (($this->request->data) && $user->save()) {
            return $this->redirect('Users::index');
        }
        return compact('user');
    }
}

?>