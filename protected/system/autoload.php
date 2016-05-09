<?php

return function ($class) {

	$paths = [
		'config' => CONFIG_PATH,
		'system' => SYSTEM_PATH,
		'service' => SERVICE_PATH,
		'controllers' => CONTROLLERS_PATH,
	];
	
	$file_name = lcfirst($class);
	foreach ($paths as $path) {
		if(file_exists($path.$file_name.'.php')){
			require_once $path.$file_name.'.php';
			return true;
		}
	}
	throw new Exception("can't find {$class} {$file_name} in protected folder");	
};