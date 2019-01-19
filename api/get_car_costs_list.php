<?php 
		

		require("access_comp.php");
	//--------------odczytywanie parametrów od datatable-------------------------------------
		$start = $_GET["start"]; // od ktorego rekordu
		$length=$_GET["length"]; // ile rekordow
		$sort_order= $_GET["order"]; 
		$draw=$_GET["draw"]; //nr porzadkowy wywolania
		$search= $_GET["search"];
		$search=$search[value]; //wyszukiwany tekst
		$order_dir = $sort_order['0']['dir']; //kierunek sortowania

	//--------------Koniec - odczytywanie parametrów od datatable-------------------------------------		
		switch ($sort_order['0']['column']) // zamiana nr kolumny sortowania na nazwe kolumny
			{
			case 0:
				$column="koszty.Data";
			break;
			case 1:
				$column='sklepy.nazwa';
			break;
			case 2:
				$column='koszty.ndk';
			break;
			case 3:
				$column='koszty.opis';
			break;
			case 4:
				$column='koszty.koszt';
			break;			
			default:
				$column="koszty.Data";
			break;
			}
		
			//echo $column;

			$tabela='koszty';
			$parametr='Data';
			//$nazwa_pola='stawka,ilosc';
			
			//echo $search;
			
			if (isset($search)) {
				$sql = "select koszty.Data, koszty.id_kosztu, sklepy.nazwa, koszty.ndk, koszty.opis, koszty.koszt from koszty,sklepy where (((koszty.Data like '%".$search."%') or (sklepy.nazwa like '%".$search."%') or (koszty.ndk like '%".$search."%') or (koszty.opis like '%".$search."%') or (koszty.koszt like '%".$search."%')) and (sklepy.id_sklepu=koszty.id_sklepu) and (koszty.sam =1)) ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;

				//$sql="select koszty.Data, koszty.id_kosztu, sklepy.nazwa, koszty.ndk, koszty.opis, koszty.koszt from koszty,sklepy where sklepy.id_sklepu=koszty.id_sklepu and koszty.sam is null";

				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM koszty where koszty.sam=1");
					$total_rows = $total_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wierszy
				
				//zliczanie całkowitej liczby wyfiltrowanych wierszy
					$filtered_rows=$db->GetArray("SELECT COUNT(*) FROM koszty,sklepy where (((koszty.Data like '%".$search."%') or (sklepy.nazwa like '%".$search."%') or (koszty.ndk like '%".$search."%') or (koszty.opis like '%".$search."%') or (koszty.koszt like '%".$search."%')) and (sklepy.id_sklepu=koszty.id_sklepu) and (koszty.sam=1))");
									
					$filtered_rows = $filtered_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wyfiltrowanych wierszy						
				
			}else{  
			
				$sql= "select koszty.Data, koszty.id_kosztu, sklepy.nazwa, koszty.ndk, koszty.opis, koszty.koszt from koszty,sklepy where ((sklepy.id_sklepu=koszty.id_sklepu) and (koszty.sam=1)) ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;
				
				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM koszty where koszty.sam is null");
					$total_rows = $total_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wierszy
					$filtered_rows = $total_rows;			
			}
			
			//echo "liczba wszystkich wierszy: ".$total_rows." liczba wyfiltrowanych wierszy: ".$filtered_rows." ";	
			
		
				$arr=$db->GetArray($sql);
				//			print "<pre>";
				//			var_export($arr);
				//			print "</pre>";
				//rsort($arr);		

				$st='{"draw":'.$draw.',"recordsTotal":'.$total_rows.',"recordsFiltered":'.$filtered_rows.',"data":[';

				foreach($arr as $k=>$v){
						$st.='["'.$v['Data'].'","'.$v['nazwa'].'","'.$v['ndk'].'","'.$v['opis'].'","'.$v['koszt'].'","<button class=\'btn btn-primary btn-100\' onclick = \"deleteRecord(\'<p>Usuwam koszt</p>\', \'koszty\', \'id_kosztu\',\''.$v['id_kosztu'].'\',\'<p>Koszt usunięty poprawnie</p>\',refreshTable)\">Usuń</button>"],';
				}
				
				$st = rtrim($st, ",");
				$st.=']}';
				echo $st;
		?>
		
		
		
		
