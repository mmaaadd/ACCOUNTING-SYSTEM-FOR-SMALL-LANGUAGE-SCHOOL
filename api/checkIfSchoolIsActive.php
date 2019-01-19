<?php 
	require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$invoiceID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
    //check if ID is a number and if yes then proceed
    if (isset($invoiceID) && is_numeric($invoiceID)){
 				$sql="SELECT szkoly.aktywna FROM szkoly, rachunek WHERE szkoly.id_szkoly=rachunek.id_szkoly AND rachunek.id_rachunku=".$invoiceID; 	
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				foreach($arr as $k=>$v){
						$st='{"aktywna":"'.$v['aktywna'].'"}';
				}
    } else {
            $st='{error:"Niewłaściwe ID elementu"}' ;  
    }
    echo $st; 
?>