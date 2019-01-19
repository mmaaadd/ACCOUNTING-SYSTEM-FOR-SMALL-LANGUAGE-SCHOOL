<?php 
	require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
	$invoiceID = $_POST["ID"]; // ID recordu
	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
    //check if ID is a number and if yes then proceed
    if (isset($invoiceID) && is_numeric($invoiceID)){
 				$sql="select rachunek.data_wystawienia, rachunek.nr_rachunku, rachunek.kwota, rachunek.id_rachunku, rachunek.za_etat, szkoly.nazwa, szkoly.id_szkoly, rachunek.termin_platnosci, rachunek.tytulem, rachunek.kwota_netto, rachunek.od, rachunek.do from rachunek,szkoly where rachunek.id_szkoly=szkoly.id_szkoly AND rachunek.id_rachunku=".$invoiceID; 	
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				foreach($arr as $k=>$v){
						$st='{"data_wystawienia":"'.$v['data_wystawienia'].'", "nr_rachunku":"'.$v['nr_rachunku'].'", "za_etat":"'.$v['za_etat'].'", "id_rachunku":"'.$v['id_rachunku'].'", "nazwa_szkoly":"'.$v['nazwa'].'", "id_szkoly":"'.$v['id_szkoly'].'", "termin_platnosci":"'.$v['termin_platnosci'].'", "tytulem":"'.$v['tytulem'].'", "kwota_netto":"'.$v['kwota_netto'].'", "kwota_brutto":"'.$v['kwota'].'", "data_od":"'.$v['od'].'", "data_do":"'.$v['do'].'"}';
				}
    } else {
            $st='{error:"Niewłaściwe ID elementu"}' ;  
    }
    echo $st; 
?>