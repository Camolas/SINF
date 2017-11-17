<?php 
include('../../config/init.php');

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $PRIMAVERA_ADDRESS . 'api/agenda/?representative_id=' . $_SESSION['user_id']);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$resp = curl_exec($curl);
curl_close($curl);
	
$obj = json_decode($resp, true);
$string = '{"success": 1,"result": [';

foreach ($obj as $key => $value) {
	$class = "event-success";
	if(strcmp($value['type'], 'Compromisso') == 0) {
		$class = "event-important";
	} else if(strcmp($value['type'],'Envio de Carta') == 0) {
		$class = "event-success";
	}else if(strcmp($value['type'], 'Reunião') == 0) {
		$class = "event-warning";
	}else if(strcmp($value['type'], 'Envio de Email') == 0) {
		$class = "event-info";
	}else if(strcmp($value['type'], 'Telefonema') == 0) {
		$class = "event-inverse";
	}else if(strcmp($value['type'], 'Cobrança') == 0) {
		$class = "event-special";
	}else if(strcmp($value['type'], 'Tarefa') == 0) {
		$class = "event-important";
	}else if(strcmp($value['type'], 'Envio de Proposta') == 0) {
		$class = "event-success";
	}else if(strcmp($value['type'], 'Apresentação de proposta') == 0) {
		$class = "event-warning";
	}
	$string = $string . '{
							"id": "' . $value['id'] . '",
							"title": "' . $value['title'] . '",
							"url": "' . $BASE_URL. 'pages/activity.php?title=' .$value['title'] .
																	'&client=' .$value['client'] .
																	'&type=' . $value['type'] .
																	'&location=' . $value['location'] .
																	'&notes=' . $value['notes'] .
																	'&start_date=' . $value['start_date'] .
																	'&end_date=' . $value['end_date'] .
																	'&id=' . $value['id'] .'",
							"class": "' . $class . '",
							"start": "' . (strtotime($value['start_date']))*1000 . '",
							"end": "' . (strtotime($value['end_date']))*1000 . '"}';
	if($key != (sizeof($obj) - 1)){
		$string = $string . ",";
	}
}
$string = $string . ']}';
echo $string;



/*
{
	"success": 1,
	"result": [
		{
			"id": "293",
			"title": "This is warning class event with very long title to check how it fits to evet in day view",
			"url": "http://www.example.com/",
			"class": "event-warning",
			"start": "1362938400000",
			"end":   "1363197686300"
		},
		{
			"id": "256",
			"title": "Event that ends on timeline",
			"url": "http://www.example.com/",
			"class": "event-warning",
			"start": "1363155300000",
			"end":   "1363227600000"
		},
		{
			"id": "276",
			"title": "Short day event",
			"url": "http://www.example.com/",
			"class": "event-success",
			"start": "1363245600000",
			"end":   "1363252200000"
		},
		{
			"id": "294",
			"title": "This is information class ",
			"url": "http://www.example.com/",
			"class": "event-info",
			"start": "1363111200000",
			"end":   "1363284086400"
		},
		{
			"id": "297",
			"title": "This is success event",
			"url": "http://www.example.com/",
			"class": "event-success",
			"start": "1363234500000",
			"end":   "1363284062400"
		},
		{
			"id": "54",
			"title": "This is simple event",
			"url": "http://www.example.com/",
			"class": "",
			"start": "1363712400000",
			"end":   "1363716086400"
		},
		{
			"id": "532",
			"title": "This is inverse event",
			"url": "http://www.example.com/",
			"class": "event-inverse",
			"start": "1364407200000",
			"end":   "1364493686400"
		},
		{
			"id": "548",
			"title": "This is special event",
			"url": "http://www.example.com/",
			"class": "event-special",
			"start": "1363197600000",
			"end":   "1363629686400"
		},
		{
			"id": "295",
			"title": "Event 3",
			"url": "http://www.example.com/",
			"class": "event-important",
			"start": "1364320800000",
			"end":   "1364407286400"
		}
	]
}

*/
?>