<?php

	if(isset($_POST["JSONData"])){
		$json = json_decode($_POST["JSONData"]);
		$result = json_decode($json->Result);
		if($json->Status == 'SUCCESS'){
			echo "請至超商輸入下列代碼<br>" . $result->CodeNo;
			
		}
		else {//交易失敗
			
		}
	}
?>