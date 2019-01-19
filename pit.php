<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_pit").addClass("active-link");
    }
</script>

<?php
	$st='
            <table  class="table table-striped table-bordered table-hover"><thead> 
                <tr>
                    <th width="16%">
                        <p>Za okres</p>
                    </th>
                    <th width="14%">
                        <p>Przychód</p>
                    </th>
                    <th width="14%">
                        <p>Koszty</p>
                    </th>
                    <th width="14%">
                        <p>Dochód</p>
                    </th>
                    <th width="14%">
                        <p>Ubezp. Sp.</p>
                    </th>
                    <th width="14%">
                        <p>Ubezp.zdr</p>
                    </th>
                    <th width="14%">
                        <p>Suma podatku</p>
                    </th>
                </tr></thead><tbody>';
	$rok = date("Y");
	$miesiac=date("m");
	$poczatek = 1293836400;
	$dzis=strtotime(date("Y").'-'.date("m"));
		while ($dzis>=$poczatek)
			{
								if ($miesiac!=12)
											{
											$nast_miesiac=$miesiac+1;
											$nast_rok=$rok;
											}
										else
											{
											$nast_miesiac=1;
											$nast_rok=$rok+1;
											}
								
								//echo $rok.'<br>';
								//echo $miesiac.'<br>';
								//echo $nast_miesiac.'<br>';
								//echo $nast_rok.'<br>';
								//echo strtotime(date("Y").'-'.date("m"));
					//			echo 'od poczÄ�tku roku do: ';
								$do=$nast_rok.'-'.$nast_miesiac;
					//			echo $do.'<br>';
								$do=strtotime($do);
								//echo $do.'<br>';
							//-----------------pobranie i zsumowanie wszystkich rachunkĂłw-----------	
											$sql='select kwota from rachunek where data_wystawienia<"'.$nast_rok.'-'.$nast_miesiac.'-01" and data_wystawienia>="'.$rok.'-01-01"';
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											$przychod=0;
											foreach($arr as $k=>$v)
												{
												$przychod=$przychod+$v['kwota'];
												}					
											//echo 'przychód: '.$przychod.'<br>';
							//-----------------pobranie i zsumowanie wszystkich kosztĂłw-----------
											$sql='select koszt from koszty where Data<"'.$nast_rok.'-'.$nast_miesiac.'-01" and Data>="'.$rok.'-01-01"';
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											$koszty=0;
											foreach($arr as $k=>$v)
												{
												$koszty=$koszty+$v['koszt'];
												}					
						//					echo 'koszty: '.$koszty.'<br>';
							//----------------pobranie i zsumowanie ubez zdr--------------	
											$sql='select kwota from ubez_zdr where data_przelewu<"'.$nast_rok.'-'.$nast_miesiac.'-01" and data_przelewu>="'.$rok.'-01-01"';
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											$UZ=0;
											foreach($arr as $k=>$v)
												{
												$UZ=$UZ+$v['kwota'];
												}					
									//		echo $UZ.'<br>';

							//----------------pobranie i zsumowanie ubez sp--------------	
											$sql='select kwota from ubez_sp where data_przelewu<"'.$nast_rok.'-'.$nast_miesiac.'-01" and data_przelewu>="'.$rok.'-01-01"';
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											$US=0;
											foreach($arr as $k=>$v)
												{
												$US=$US+$v['kwota'];
												}					
									//		echo $US.'<br>';
							//----------------pobranie kwoty wolnej--------------	
											$sql='select kwota from kwota_wolna where za_rok="'.$rok.'"';
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											foreach($arr as $k=>$v)
												{
												$kwota_wolna=$v['kwota'];
												}					
									//		echo $kwota_wolna.'<br>';				
							//--------obliczenia-------------------------------
							$dochod=$przychod-$koszty;
					//		echo $dochod.'<br>';
							$podstawa=$dochod-$US;
					//		echo 'podstawa '.$podstawa.'<br>';
							$podstawa=round($podstawa);
					//		echo $podstawa.'<br>';
							$pod_podstawa=$podstawa*0.18-$kwota_wolna;
					//		echo $pod_podstawa.'<br>';
							$UZ=$UZ/9*7.75;
							$UZ=round($UZ,2);
					//		echo $UZ.'<br>';
							$pod_poUZ=$pod_podstawa-$UZ;
							$pod_suma=round($pod_poUZ);
					//		echo $pod_suma.'<br>';

							//----------------pobranie sumy zapłaconego podatku--------------	
											$sql='select kwota from podatek where za_okres>="'.$rok.'-01-01" and za_okres<"'.$nast_rok.'-'.$nast_miesiac.'-01"';
											//echo $sql;
												$arr=$db->GetArray($sql);
												//	print "<pre>";
												//	var_export($arr);
												//	print "</pre>";
											$zaplac=0;	
											foreach($arr as $k=>$v)
												{
												$zaplac=$zaplac+$v['kwota'];
												}					
						//					echo $zaplac.'<br>';				
							//-------------------------------------------------------------
							$do_zaplaty=$pod_suma-$zaplac;
						//	echo $do_zaplaty;
								
									
								$st.='<tr><td><p>'.$rok.'-'.$miesiac.'</p></td><td><p>'.number_format ( $przychod, 2 , ',', ' ').' zł</p></td><td><p>'.number_format ( $koszty, 2 , ',', ' ').' zł</p></td><td><p>'.number_format ( $dochod, 2 , ',', ' ').' zł</p></td><td><p>'.number_format ( $US, 2 , ',', ' ').' zł</p></td><td><p>'.number_format ( $UZ, 2 , ',', ' ').' zł</p></td><td><p>'.number_format ( $pod_suma, 2 , ',', ' ').' zł</p></td></td></tr>';
			
				if ($miesiac!=1)
					{
					$miesiac=$miesiac-1;
					}
				else
					{
					$miesiac=12;
					$rok=$rok-1;
					}
			$dzis=strtotime($rok.'-'.$miesiac);
			}
			
				$st.='</tbody></table>';
				echo $st;
		?>