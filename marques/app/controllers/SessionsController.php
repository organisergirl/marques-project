<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
 
namespace app\controllers;

use lithium\security\Auth;

/**
 * Manage authentication actions
 */

class SessionsController extends \lithium\action\Controller {

	/**
	 * authenticate the user
	 */
    public function add() {
        if ($this->request->data && Auth::check('default', $this->request)) {
            return $this->redirect('/users');
        }
        // Handle failed authentication attempts
    }

    /**
     * clear the authentication of the user
     */
    public function delete() {
        Auth::clear('default');
        return $this->redirect('/');
    }
}



?>