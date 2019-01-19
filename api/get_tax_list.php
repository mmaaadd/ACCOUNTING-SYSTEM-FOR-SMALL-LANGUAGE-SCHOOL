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
				$column="podatek.za_okres";
			break;
			case 1:
				$column='podatek.data_przelewu';
			break;
			case 2:
				$column='podatek.kwota';
			break;
			default:
				$column="podatek.za_okres";
			break;
			}
		
			//echo $column;

			//$tabela='podatek';
			//$parametr='data';
			//$nazwa_pola='stawka,ilosc';
			
			//echo $search;
			
			if (isset($search)) {
      
          
				$sql = "select * from podatek where ((podatek.za_okres like '%".$search."%') or (podatek.kwota like '%".$search."%') or (podatek.data_przelewu like '%".$search."%')) ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;  
        
        //echo $sql;

				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `podatek`");
					$total_rows = $total_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wierszy
				
				//zliczanie całkowitej liczby wyfiltrowanych wierszy
					$filtered_rows=$db->GetArray("SELECT COUNT(*) FROM podatek where (((podatek.za_okres like '%".$search."%') or (podatek.kwota like '%".$search."%') or (podatek.data_przelewu like '%".$search."%')))");
									
					$filtered_rows = $filtered_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wyfiltrowanych wierszy						
				
			}else{  
				$sql="select distinct * from podatek ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;
				
				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `podatek`");
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
						$st.='["'.$v['za_okres'].'","'.$v['data_przelewu'].'","'.number_format ( $v['kwota'], 2 , ',', ' ').' zł","<button class=\'btn btn-primary btn-100\' onclick = \"deleteRecord(\'<p>Usuwam podatek</p>\', \'podatek\', \'id_podatku\',\''.$v['id_podatku'].'\',\'<p>Zajęcia usunięte poprawnie</p>\',refreshTable)\">Usuń</button>"],';                               
				}
				$st = rtrim($st, ",");
				$st.=']}';
				echo $st;
		?>

