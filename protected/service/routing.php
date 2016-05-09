<?php

class Routing extends Service {
	
	public $defaultController = 'map';
	public $controller = '';
	public $action = '';

	public function rout($url) {
		$url = parse_url($url);
		$query = !empty($url['query'])?$url['query']:'';
		$path = explode('/', $url['path']);
	
		if(empty($path[1])) {
			$this->controller = $this->defaultController;
			$this->action = null;	
		} else {
			$this->controller = $path[1];
			if(empty($path[2])) {
				$this->action = null;
			} else {
				$this->action = $path[2];
			}
		}

	}
}