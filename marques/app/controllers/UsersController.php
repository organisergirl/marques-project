<?php
/**
 *  This file is part of MARQUes - Maps Answering Research Questions.
 *
 *  MARQUes is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  MARQUes is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with MARQUes.  If not, see <http://www.gnu.org/licenses/>.
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
        return compact('users');
    }
}

?>