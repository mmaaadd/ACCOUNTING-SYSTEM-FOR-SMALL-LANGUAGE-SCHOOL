<?php 
	require("access_comp.php");

    //check if ID is a number and if yes then proceed
    if (isset($_POST["ID"]) && is_numeric($_POST["ID"])){
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$rateID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable---------------------------------        
 				$sql="SELECT szkoly.aktywna FROM szkoly, stawki WHERE szkoly.id_szkoly=stawki.id_szkoly AND stawki.id_stawki=".$rateID; 	
		
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