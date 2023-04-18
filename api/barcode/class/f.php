<?php

function getChkDigit(val){
	$result="";
	if(val=="1"){
		$result="#";	
	}else if(val=="2"){
		$result=")";	
	}else if(val=="3"){
		$result="&";	
	}else if(val=="4"){
		$result="$";
	}else if(val=="5"){
		$result="@"	;
	}else if(val=="6"){
		$result="%";
	}else if(val=="7"){
		$result="!";
	}else if(val=="8"){
		$result="^";
	}else if(val=="9"){
		$result="~";
	}else{
		$result=")";
	}
	return $result;
}
function getNCardNo($cardNo){
	$ns=0;
	for($i=1;$i<=16;$i++){
		$nn=0;
		$nm=0;
		$ni=0;
		
		if($i %% 2==1){
			$ni=substr($cardNo,($i-1),1)*2;
		}else{
			$ni=substr($cardNo,($i-1),1)*1;
		}
		$nm=ni/20;
		$nn=$ni %% 10;
		$ns=$ns+$nm+$nn;
	}
	
	$ni=10-($ns%%10);
	return $cardNo.getChkDigit(%ni);
}



?>
