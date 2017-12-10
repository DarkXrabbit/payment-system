<?php
	//SakuraHosting-櫻域伺服器代管 收費系統2.0
	//增加備註功能
	date_default_timezone_set("Asia/Taipei");
	if(isset($_POST["Amt"]) && isset($_POST["ItemDesc"]) && isset($_POST["Email"]) /*&& isset($_POST["LoginType"])*/ && isset($_POST["Method"])){
		
		$pay_method = array();
		$pay_method["CREDIT"] = 0;
		$pay_method["CVS"] = 0;
		$pay_method["VACC"] = 0;
		$pay_method["WEBATM"] = 0;
		$pay_method["UNIONPAY"] = 0;
		
		if($_POST["Method"] == 'CREDIT'){
			$pay_method["CREDIT"] = 1;
		}
		elseif($_POST["Method"] == 'CVS'){
			$pay_method["CVS"] = 1;
		}
		elseif($_POST["Method"] == 'VACC'){
			$pay_method["VACC"] = 1;
		}
		elseif($_POST["Method"] == 'WEBATM'){
			$pay_method["WEBATM"] = 1;
		}
		elseif($_POST["Method"] == 'UNIONPAY'){
			$pay_method["UNIONPAY"] = 1;
		}
		
		
		$EmailModify = 0;
		$Name = $_POST["Name"];
		$Amt = $_POST["Amt"];
		$ItemDesc = $_POST["ItemDesc"];
		$Email = $_POST["Email"];
		$OrderComment = $_POST["OrderComment"];	
		
		
		
		
		$LoginType = 0;
		$ReturnURL = "https://payment.memory-sakura.net/result_cvs.php";
		
		$t = time();
		$date1 = date("Ymd");
		$d = substr($date1,-6);	
		$time = date("His");
		$hash1 = hash("sha256", $t);
		$hash2 = hash("md5", $hash1);
		$hash3 = hash("sha256", $hash2);
		
		$order_id = $d . '_' . $time;	
		$MerchantOrderNo = $order_id;	
		
		
		$date = date("Ymd")."-";
		

		
		$hash_str = '';
		
		
		
		$url = "https://core.spgateway.com/MPG/mpg_gateway";
		$TimeStamp = time();
		$RespondType = "String";
		$MerchantID = "MS114569233";
		$Version = "1.2";
		
		$HashKey = "GYNlWM3XR9uEmcnvXkTj3ONMf1oHiwsY";
		$HashIv = "vgkr3npVwUAT6Xp3";
		
		
		
		$check_value = 'Amt=' . $Amt . '&MerchantID=' . $MerchantID . '&MerchantOrderNo=' . $MerchantOrderNo . '&TimeStamp=' . $TimeStamp . '&Version=' . $Version;
		
		$check_value = 'HashKey=' . $HashKey . '&' . $check_value;
		$check_value .= '&HashIV=' . $HashIv;	
		
		$check_value = strtoupper(hash("sha256", $check_value));


	?>
		<!DOCTYPE html>
		<html>
		<script src="lir/jquery.js"></script>
		<script>
		$(document).ready(function(){
			$("#form").submit();
		})
		</script>
		please wait..
		<form id="form" action="<?php echo $url; ?>" method="post">

			<input name="CustomerURL" value="<?php echo $ReturnURL; ?>" type="hidden"/>
			<input name="OrderComment" value="<?php echo $OrderComment; ?>" type="hidden"/>
			<input name="MerchantID" value="<?php echo $MerchantID; ?>" type="hidden"/>
			<input name="RespondType" value="JSON" type="hidden"/>
			<input name="CheckValue" value="<?php echo $check_value;?>" type="hidden"/>
			<input name="TimeStamp" value="<?php echo $TimeStamp;?>" type="hidden"/>
			<input name="Version" value="<?php echo $Version;?>" type="hidden"/>
			<input name="MerchantOrderNo" value="<?php echo $MerchantOrderNo;?>" type="hidden"/>
			<input name="Amt" value="<?php echo $Amt;?>" type="hidden"/>
			<input name="ItemDesc" value="<?php echo $Name . "[" . $ItemDesc . "]的繳費"?>" type="hidden"/>
			<input name="Email" value="<?php echo $Email;?>" type="hidden"/>
			<input name="LoginType" value="<?php echo $LoginType;?>" type="hidden"/>
			<input name="EmailModify" value="<?php echo $EmailModify;?>" type="hidden"/>

			<input name="CREDIT" value="<?php echo $pay_method["CREDIT"];?>" type="hidden"/>
			<input name="CVS" value="<?php echo $pay_method["CVS"];?>" type="hidden"/>		
			<input name="VACC" value="<?php echo $pay_method["VACC"];?>" type="hidden"/>		
			<input name="WEBATM" value="<?php echo $pay_method["WEBATM"];?>" type="hidden"/>
			<input name="UNIONPAY" value="<?php echo $pay_method["UNIONPAY"];?>" type="hidden"/>	

		</form>
		</html>
	<?php
	}
	else {
		//
	}
	?>
