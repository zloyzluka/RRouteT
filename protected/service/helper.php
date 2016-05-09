<?php 

class Helper extends Service {
	
	public function makeUrl($controller, $action = null, $params = []) {
		$url = "/{$controller}/{$action}";
		if(!empty($params)) {
			$url .="?".http_build_query($params);
		}
		return $url;
	}

	public function redirect($url) {
		header("Location: {$url}");
	}

	public function html($str) {
		return htmlspecialchars($str);
	}

	public function input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function is_ajax() {
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		    return true;
		}
		return false;
	}

	public function encodeData($header, $data) {
		$xml_info = new SimpleXMLElement($header);
		$this->arrayToXml($data,$xml_info);
		return $xml_info->asXML();
	}

	public function arrayToXml($array, &$xml_info){
		foreach($array as $key => $value) {
	        if(is_array($value)) {
	            if(!is_numeric($key)){
	                $subnode = $xml_info->addChild("$key");
	                $this->arrayToXml($value, $subnode);
	            }else{
	                $subnode = $xml_info->addChild("item$key");
	                $this->arrayToXml($value, $subnode);
	            }
	        }else {
	            $xml_info->addChild("$key",htmlspecialchars("$value"));
	        }
    	}
	}
}