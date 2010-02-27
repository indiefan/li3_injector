<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2009, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */

use \lithium\net\http\Router;

/**
 * Finally, connect the default routes.
 */
Router::connect('/{:plugin}/{:controller}/{:action}/{:id:[0-9]+}.{:type}', array('id' => null));
Router::connect('/{:plugin}/{:controller}/{:action}/{:id:[0-9]+}');
Router::connect('/{:plugin}/{:controller}/{:action}/{:args}');

?>