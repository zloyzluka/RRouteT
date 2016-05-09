<?php

class MapController extends Controller {

	public function index(){
		$this->display('index');
	}

	public function search() {
		

		$client = new SoapClient('https://apidev.rocketroute.com/notam/v1/service.wsdl');
		
		$icao = strtoupper($_POST['icao']);
		if(mb_strlen($icao)!=4) {
			$response = [
				'success' => false,
				'msg' => 'Wrong ICAO format'
			];
		} else {
			$data = $this->prepareRequest($icao);
			$response = App::rroute()->parseREQNOTAMResponce($client->getNotam($data));
			$response['INFO'] = $this->display('marker', $response['INFO'], true);
		}
		echo json_encode($response);
	}

	protected function prepareRequest($icao){
		$request = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?><REQNOTAM></REQNOTAM>";
		$data = [
			'USR' 		=> RR_USER,
			'PASSWD' 	=> RR_PWD,
			'ICAO'		=> $icao
		];
		return App::helper()->encodeData($request, $data);
	}

}