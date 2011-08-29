<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

namespace app\models;

use \lithium\util\Validator;

/**
 * Model used to manage users
 */
class Users extends \lithium\data\Model {

	/**
	 * add validation rules for the users model
	 */
	public $validates = array(
		'username'  => array(
			array('notEmpty',     'message' => 'A User Name is required'),
			array('isUniqueUser', 'message' => 'That user name is already in use')
		),
		'password'  => array('notEmpty', 'message' => 'A Password is required'),
		'firstname' => array('notEmpty', 'message' => 'The users First Name is required'),
		'lastname'  => array('notEmpty', 'message' => 'The users Last Name is required'),
		'email'     => array(
			array('notEmpty', 'message' => 'An Email Address for the user is required'),
			array('email',    'message' => 'A valid Email Address is required')
		)
	);
	
	/**
	 * extend the __init method to include a custom validator
	 */
	public static function __init(array $options = array()) {
	
		parent::__init($options);
		
		Validator::add('isUniqueUser', function ($value, $format, $options) {
			
			$conditions = array('username' => $value);
			
			return !Users::find('first', array('conditions' => $conditions));
			
		});
	
	}

}

?>