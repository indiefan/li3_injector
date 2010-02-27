<?php

use lithium\action\Dispatcher;

Dispatcher::applyFilter('run', function($self, $params, $chain) {
	xhprof_enable();
	$data = $chain->next($self, $params, $chain);
	$xhprof_data = xhprof_disable();

	$XHPROF_ROOT = '/usr/local/php/xhprof';
	include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
	include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";

	$xhprof_runs = new XHProfRuns_Default();
	$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_lithium");

	return $data;
});

?>