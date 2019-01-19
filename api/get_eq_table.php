<?php
        require("access_comp.php");


if ( (isset ($_POST['naStanie'])) && ($_POST['naStanie']==1) )
{
    $naStanie=1;
}
else
{
    $naStanie=0;
};    
		//	$nazwa_pola='stawka,ilosc';
			$sql="select nazwa_sprzetu, data_zakupu, data_utylizacji, id_sprzetu, ndk from sprzet where na_stanie=".$naStanie."";
				$arr=$db->GetArray($sql);
				sort($arr);
							//print "<pre>";
							//var_export($arr);
							//print "</pre>";
			
				$st='
				<table class="table table-striped table-bordered table-hover">
                <thead>
					<tr>
						<th width="40%">
							Opis
						</th>
						<th width="10%">
							Data zakupu
						</th>
						<th width="30%">
							Nr rachunku
						</th>						
						<th  width="10%">';
                            if($naStanie==1){
                             $st.='Edytuj/utylizuj';	                               
                            } else{
                             $st.='Data utylizacji';                                
                            }
							
							$st.='
						</th>
						<th width="10%">
                            Usuń
                        </th>
					</tr>
                    </thead><tbody>';
				foreach($arr as $k=>$v){
						$st.='
						<tr>
							<td>
								'.$v['nazwa_sprzetu'].'
							</td>
							<td>
								'.$v['data_zakupu'].'
							</td>
							<td>
								'.$v['ndk'].'
							</td>
							<td>';
                            if($naStanie==1){
                             $st.='
                             
                             
                            
								    <button class="btn btn-primary btn-100" onclick = \' showUtilizeEquipmentWindow('.$v['id_sprzetu'].')\'>Edytuj/Utylizuj</button>';	                               
                            } else{
                             $st.=$v['data_utylizacji'];                                
                            }
							
							$st.='
								
							</td>
							<td>
								    <button class="btn btn-primary btn-100" onclick = "deleteRecord(\'<p>Usuwam sprzęt</p>\', \'sprzet\', \'id_sprzetu\',\''.$v['id_sprzetu'].'\',\'<p>Sprzęt usunięty poprawnie</p>\',getEquipmentTables)">Usuń</button>
                            </td>
						</tr>';
					
				}
				$st.='</tbody></table>';
				echo $st;
		?>
