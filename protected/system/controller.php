<?php 
abstract class Controller {
	public $defaultAction = 'index';
	protected $template = 'main';

	protected function display($templateName, $data = [], $skipTemplate = false) {
		$file = VIEWS_PATH.str_replace('Controller', '', get_class($this)).DS.$templateName.'.php';
		$file = strtolower($file);
		if(file_exists($file)) {

			ob_start();
			include($file);
			$content = ob_get_clean();

			if(!$skipTemplate) {
				require(TEMPLATES_PATH.$this->template.".php");
			} else {
				return $content;
			}
		} else {
			throw new Exception("can't find view {$templateName}");			
		}
	}

	protected function bindModel($modelName) {
		try{
			$modelName .= 'Model';
			return new $modelName();

		} catch (Exception $e) {
			throw new Exception("can't init model {$modelName}, coused \"{$e->getMessage()}\"");
		}
	}
}