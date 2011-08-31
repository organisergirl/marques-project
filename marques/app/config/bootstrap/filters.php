<?php
/**
 * MARQUes - Maps Answering Research Questions
 *
 * @copyright     Copyright 2011, Flinders University (http://www.flinders.edu.au)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use lithium\security\Password;
use lithium\util\collection\Filters;

/**
 * ensure that the password field for users is securely hashed
 */
Filters::apply('app\models\Users', 'save', function($self, $params, $chain) {

    if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
    
    if(!empty($params['entity']->password)) {
    	$params['entity']->password = Password::hash($params['entity']->password);
    }
    
    return $chain->next($self, $params, $chain);
});

/**
 * adjust the created and updated fields of basic markers as appropriate
 */
Filters::apply('app\models\BasicMarkers', 'save', function($self, $params, $chain) {

	if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
	
	if (!$params['entity']->id) {
		// add the create date
		$params['entity']->created = date('Y-m-d H:i:s');
	} else {
		// add // update the modified date
		$params['entity']->updated = date('Y-m-d H:i:s');
	}
	
	return $chain->next($self, $params, $chain);
});


?>