<?php 
		

		require("access_comp.php");

		$start = $_GET["start"];
		$length=$_GET["length"];
		$sort_order= $_GET["order"];
		$draw=$_GET["draw"];
		$search= $_GET["search"];
		
		$search=$search[value];
		//echo $search;
		$order_dir = $sort_order['0']['dir'];
		//echo $order_dir;
		switch ($sort_order['0']['column'])
			{
			case 0:
				$column="zajecia.data";
			break;
			case 1:
				$column='zajecia.ilosc';
			break;
			case 2:
				$column='stawki.nazwa_stawki';
			break;
			default:
				$column="zajecia.data";
			break;
			}
		
			//echo $column;

			$tabela='zajecia';
			$parametr='data';
			$nazwa_pola='stawka,ilosc';
			
			//echo $search;
			
			if (isset($search)) {
				$sql = "select zajecia.data,zajecia.ilosc, stawki.nazwa_stawki, zajecia.opis,zajecia.id_zajec from zajecia, stawki where (((stawki.nazwa_stawki like '%".$search."%') or (zajecia.data like '%".$search."%') or (zajecia.ilosc like '%".$search."%'))and (zajecia.id_stawki=stawki.id_stawki)) ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;  

				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `zajecia`");
					$total_rows = $total_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wierszy
				
				//zliczanie całkowitej liczby wyfiltrowanych wierszy
					$filtered_rows=$db->GetArray("SELECT COUNT(*) FROM zajecia, stawki where (((stawki.nazwa_stawki like '%".$search."%') or (zajecia.data like '%".$search."%') or (zajecia.ilosc like '%".$search."%'))and (zajecia.id_stawki=stawki.id_stawki))");
									
					$filtered_rows = $filtered_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wyfiltrowanych wierszy						
				
			}else{  
				$sql="select distinct zajecia.data,zajecia.ilosc, stawki.nazwa_stawki, zajecia.opis,zajecia.id_zajec from zajecia, stawki where zajecia.id_stawki=stawki.id_stawki  ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;
				
				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `zajecia`");
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
						$st.='["'.$v[$parametr].'","'.$v['ilosc'].'","'.$v['nazwa_stawki'].'","<button class=\'btn btn-primary btn-100\' onclick = \"deleteRecord(\'<p>Usuwam zajecia</p>\', \'zajecia\', \'id_zajec\',\''.$v['id_zajec'].'\',\'<p>Zajęcia usunięte poprawnie</p>\',refreshTable)\">Usuń</button>"],';
				}
				$st = rtrim($st, ",");
				$st.=']}';
				echo $st;
		?>
