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
 * Model used to manage Australian State records
 */
class FilmWeeklyArchaeology extends \lithium\data\Model {

	/**
	 * override default id column
	 */
	protected $_meta = array(
		'key' => 'archaeology_id'
	);

	/**
	 * add relationships to the model
	 */
	public $hasOne = array(
		'FilmWeeklyCinemas' => array(
			'class'      => 'FilmWeeklyCinemas',
			'key'        => 'film_weekly_cinemas_id',
			'conditions' => array(),
			'fields'     => array(),
			'order'      => null,
			'limit'      => null,
		),
		'FilmWeeklyCategories' => array(
			'class'      => 'FilmWeeklyCategories',
			'key'        => 'film_weekly_categories_id',
			'conditions' => array(),
			'fields'     => array(),
			'order'      => null,
			'limit'      => null,
		)
	);

	/**
	 * add validation rules for the model
	 */
	public $validates = array(
		'film_weekly_cinemas_id' => array(
			array('notEmpty',   'message' => 'The id of the parent cinema record is required')
		),
		'film_weekly_categories_id' => array(
			array('notEmpty',   'message' => 'The id of a film weekly category is required')
		),
		'cinema_name' => array(
			array('notEmpty',      'message' => 'A theatre name is required'),
			array('lengthBetween', 'message' => 'A theatre name cannot be longer than 512 characters',
				'min' => 0,
				'max' => 512)
		),
		'exhibitor_name' => array(
			array('notEmpty',      'message' => 'An exhibitor name is required'),
			array('lengthBetween', 'message' => 'An exhibitor name cannot be longer than 512 characters',
				'min' => 0,
				'max' => 512)
		),
		'capacity' => array(
			array('notEmpty',   'message' => 'The capacity of the theatre is required'),
			array('numeric',    'message' => 'The capacity of the theatre must be a number')
		)
	);
}
?>