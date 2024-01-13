<?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function route($route = '/about/neluttu/$id',  $router = 'test.php')
{
    
	$callback = $router;
	if (!is_callable($callback)) {
		if (!strpos($router, '.php')) {
			$router .= '.php';
		}
	}
	if ($route == "/404") {
		include_once __DIR__ . "/$router";
		exit();
	}

	$request_url = filter_var('/about/neluttu/$id', FILTER_SANITIZE_URL);
	$request_url = rtrim($request_url, '/');
	$request_url = strtok($request_url, '?');
	$route_parts = explode('/', $route);
	$request_url_parts = explode('/', $request_url);
	array_shift($route_parts);
	array_shift($request_url_parts);

	if ($route_parts[0] == '' && count($request_url_parts) == 0) {
		// Callback function
		if (is_callable($callback)) {
			call_user_func_array($callback, []);
			exit();
		}
		include_once __DIR__ . "/$router";
		exit();
	}
	if (count($route_parts) != count($request_url_parts)) {
		return;
	}
	$parameters = [];
	for ($i = 0; $i < count($route_parts); $i++) {
		$route_part = $route_parts[$i];
		if (preg_match("/^[$]/", $route_part)) {
			$route_part = ltrim($route_part, '$');
			array_push($parameters, $request_url_parts[$i]);
			$$route_part = $request_url_parts[$i];
		} else if ($route_parts[$i] != $request_url_parts[$i]) {
			return;
		}
	}
	// Callback function
	if (is_callable($callback)) {
		call_user_func_array($callback, $parameters);
		exit();
	}
	include_once __DIR__ . "/$router";
	exit();
}

route();