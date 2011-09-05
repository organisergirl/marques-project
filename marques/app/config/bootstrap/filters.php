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
 * ensure state short names are always upper case
 */
Filters::apply('app\models\AustralianStates', 'save', function($self, $params, $chain) {

	if ($params['data']) {
        $params['entity']->set($params['data']);
        $params['data'] = array();
    }
    
    if(!empty($params['entity']->shortname)) {
    	$params['entity']->shortname = strtoupper($params['entity']->shortname);
    }
    
    if(!empty($params['entity']->longname)) {
    	$params['entity']->longname = ucwords(strtolower($params['entity']->longname));
    }
    
    return $chain->next($self, $params, $chain);

});


?>