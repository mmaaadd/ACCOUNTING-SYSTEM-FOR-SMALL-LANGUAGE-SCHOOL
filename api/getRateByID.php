<?php 
	require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$rateID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
    //check if ID is a number and if yes then proceed
    if (isset($rateID) && is_numeric($rateID)){
 				$sql="select szkoly.nazwa,stawki.* from szkoly,stawki where stawki.id_szkoly=szkoly.id_szkoly and id_stawki=".$rateID; 	
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				foreach($arr as $k=>$v){
						$st='{"nazwa":"'.$v['nazwa'].'", "nazwa_stawki":"'.$v['nazwa_stawki'].'", "tytul":"'.$v['tytul'].'", "czas":"'.$v['czas'].'", "kwota":"'.$v['kwota'].'", "aktywna":"'.$v['aktywna'].'", "id_szkoly":"'.$v['id_szkoly'].'"}';
				}
    } else {
            $st='{error:"Niewłaściwe ID elementu"}' ;  
    }
    echo $st; 
?>