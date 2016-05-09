<?php 

class App {

	protected $config;
	protected static $instance;

	protected function __construct(Config $config) {
		$this->config = $config;
		$modules = $this->config->modules;
		foreach ($modules as $moduleName => $moduleConfig) {
			$this->$moduleName = new $moduleName();
		}
	} 

	public static function getInstance($config = null) {
		if (!static::$instance) {
			static::$instance = new static($config);	
		}
		return static::$instance;
	} 

	public static function __callStatic($name, $argv) {
		$instance = static::getInstance();
		if(isset($instance->$name)) {
			return $instance->$name;
		}
		throw new Exception("can't find $name");
	} 
	
	public function run() {
		$this->routing->rout($_SERVER['REQUEST_URI']);
		try {
			$controllerName = $this->routing->controller.'Controller';
			$controller = new $controllerName();
			$action = $this->routing->action?$this->routing->action:$controller->defaultAction;
			if(method_exists($controller, $action)) {
				$controller->$action();
			} else {
				throw new Exception("can't find action {$action} in {$this->routing->controller}");
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
	}

}