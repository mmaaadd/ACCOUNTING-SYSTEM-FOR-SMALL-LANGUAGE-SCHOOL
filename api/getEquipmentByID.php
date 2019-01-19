<?php 
	require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$eqID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
    //check if ID is a number and if yes then proceed
    if (isset($eqID) && is_numeric($eqID)){
 				$sql = "select nazwa_sprzetu, data_zakupu, data_utylizacji, id_sprzetu, ndk from sprzet where id_sprzetu=".$eqID; 	
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				foreach($arr as $k=>$v){
						$st='{"id":"'.$v['id_sprzetu'].'", "name":"'.$v['nazwa_sprzetu'].'", "buyDate":"'.$v['data_zakupu'].'", "utilizationDate":"'.$v['data_utylizacji'].'", "ndk":"'.$v['ndk'].'"}';
				}
    } else {
            $st='{error:"Niewłaściwe ID elementu"}' ;  
    }
    echo $st; 
		?>