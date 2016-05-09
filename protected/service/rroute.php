<?php 
class Rroute extends Service {
	public function parseREQNOTAMResponce($str) {
		$data = new SimpleXMLElement($str); 
		$res['success'] = false;
		if($data->result == 0) {
			$count = $data->NOTAMSET[0]->count();
			if($count == 0) {
				$res['msg'] = 'server sent empty response';
			} else {
				for ($i = 0; $i<$count; $i++) {
					if(empty($res['GEO'])) {
						$res['GEO'] = $this->parseItemQ($data->NOTAMSET[0]->NOTAM[$i]->ItemQ);
						$res['STR'] = $data->NOTAMSET[0]->NOTAM[$i]->ItemQ;	
						if(empty($res['GEO'])) {
							$res['msg'] = 'Unexpected responce format';
							break;
						} else {
							$res['success'] = true;
						}
					}
					$res['INFO'][] = $data->NOTAMSET[0]->NOTAM[$i]->ItemE;
				}
			}
		} else {
			if($data->result == 1) {
				$res['msg'] = 'No NOTAM found please check ICAO';
			} else {
				$res['msg'] = 'Unknown error on server side';
			}
		}
		return $res;
	}

	protected function parseItemQ($str) {
		$reg = '/(\d*[N,S])(\d*[W,E])/';
		preg_match_all($reg, $str, $matches);
		if(!empty($matches[1][0]) && !empty($matches[2][0])) {
			$lat = $this->convertGEO($matches[1][0]);
			$lng = $this->convertGEO($matches[2][0]);
			
			$geo = [
				'lat'=>$lat,
				'lng'=>$lng,
			];
		} else {

		}
		return $geo;
	} 
	protected function convertGEO($str) {
		$ret = '';
		$dig = (int)$str;

		$let = substr($str, -1, 1);

		if($dig < 1000){
			$latD = ($dig + $dig/100)/60;
		} else {
			$latP = $dig % 100;
			$latD = ($dig/100<<0) + ($latP + $latP/100 )/60;
		}
		switch ($let ) {
			case 'W':
			case 'S':
				$ret = $latD * -1;
				break;
			
			default:
				$ret = $latD;
				break;
		}
		return $ret;
	}
}
