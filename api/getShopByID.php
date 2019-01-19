<?php 
	require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$shopID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
    //check if ID is a number and if yes then proceed
    if (isset($shopID) && is_numeric($shopID)){
 				$sql = "select * from sklepy where id_sklepu=".$shopID; 	
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				foreach($arr as $k=>$v){
						$st='{"nazwa":"'.$v['nazwa'].'", "ulica":"'.$v['ulica'].'", "kod_pocztowy":"'.$v['kod_pocztowy'].'", "miejscowosc":"'.$v['miejscowosc'].'", "id_sklepu":"'.$v['id_sklepu'].'", "aktywna":"'.$v['aktywna'].'"}';
				}
    } else {
            $st='{error:"Niewłaściwe ID elementu"}' ;  
    }
    echo $st; 
?>