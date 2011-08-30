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
 * Model used to manage basic markers
 */
class BasicMarkers extends \lithium\data\Model {

	/**
	 * add validation rules for the users model
	 */
	public $validates = array(
		'title'       => array('notEmpty', 'message' => 'A title for the marker is required'),
		'description' => array('notEmpty', 'message' => 'A description for the marker is required'),
		'latitude'    => array(
			array('notEmpty', 'message' => 'A latitude geo-coordinate is required'),
			array('decimal',  'message' => 'A latitude geo-coordinate must be a decimal number')
		),
		'longitude'    => array(
			array('notEmpty', 'message' => 'A longitude geo-coordinate is required'),
			array('decimal',  'message' => 'A longitude geo-coordinate must be a decimal number')
		)
	);
}
?>