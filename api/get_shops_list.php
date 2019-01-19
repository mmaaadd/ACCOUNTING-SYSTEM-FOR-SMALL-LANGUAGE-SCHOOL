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
				$column="nazwa";
			break;
			case 1:
				$column='ulica';
			break;
			case 2:
				$column='aktywna';
			break;
			default:
				$column="nazwa";
			break;
			}
		
			//echo $column;

			//$tabela='zajecia';
			//$parametr='data';
			//$nazwa_pola='stawka,ilosc';
			
			//echo $search;
			
			if (isset($search)) {
				$sql = "select * from sklepy where (((nazwa like '%".$search."%') or (ulica like '%".$search."%') or (kod_pocztowy like '%".$search."%') or (miejscowosc like '%".$search."%'))) ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;  

				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `sklepy`");
					$total_rows = $total_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wierszy
				
				//zliczanie całkowitej liczby wyfiltrowanych wierszy
					$filtered_rows=$db->GetArray("SELECT COUNT(*) FROM sklepy where (((nazwa like '%".$search."%') or (ulica like '%".$search."%') or (kod_pocztowy like '%".$search."%') or (miejscowosc like '%".$search."%')))");
									
					$filtered_rows = $filtered_rows['0']['COUNT(*)'];
				//KONIEC - zliczanie całkowitej liczby wyfiltrowanych wierszy						
				
			}else{  
				$sql="select distinct * from sklepy ORDER BY ".$column." ".$order_dir." limit ".$start.", ".$length;
				
				//zliczanie całkowitej liczby wierszy
					$total_rows=$db->GetArray("SELECT COUNT(*) FROM `sklepy`");
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
            //sprawdzenie czy sklep jest aktywny
            if ($v['aktywna']==0)
    						{
                                
    							$styl='style=\'color: darkgray; font-style: italic;\'';
                                $update= '<button class=\'btn btn-info btn-100\' onclick = \"switchState(\''.$v['id_sklepu'].'\',1,\'shop\',\'<p>Włączam sklep</p>\',refreshTable)\">Włącz</button>';                

                  
    						}
    					else
    						{
    							$styl='';
                                $update= '<button class=\'btn btn-primary btn-100\' onclick = \"switchState(\''.$v['id_sklepu'].'\',0,\'shop\',\'<p>Wyłączam sklep</p>\',refreshTable)\">Wyłącz</button>';
    						}
            //koniec sprawdzenia        
        
              //--------------------------------------------       
                  
                    $st.='["<span '.$styl.'>'.$v['nazwa'].'</span>","<span '.$styl.'>'.$v['ulica'].'<br>'.$v['kod_pocztowy'].' '.$v['miejscowosc'].'</span>","'.$update.'","<button class=\'btn btn-primary btn-100\' onclick = \"showEditShopWindow(\''.$v['id_sklepu'].'\')\">Edytuj</button>"],';
				}
				$st = rtrim($st, ",");
				$st.=']}';
				echo $st;
		?>

