	<?php
			
            require("access_comp.php");
			$sql="select data_przelewu,kwota,opis,id_uz from ubez_sp";
				$arr=$db->GetArray($sql);
							rsort($arr);
					//		print "<pre>";
					//		var_export($arr);
					//		print "</pre>";
							
				$st='   
                        <table   class="table table-striped table-bordered table-hover"> 
                            <tr >
                                <th width="25%">
                                    <p>Data przelewu</p>
                                </th>
                                <th width="25%">
                                    <p> Kwota </p>
                                </th>
                                <th width="25%">
                                    <p>Opis</p>
                                </th>
                                <th width="25%">
                                </th>
                            </tr></thead><tbody>';

				foreach($arr as $k=>$v){
					$ts = strtotime($v['data']);
					//if ($ts>= $od && $ts<=$do){
						$st.='<tr ><td><p>'.$v['data_przelewu'].'</p></td><td><p>  '.$v['kwota'].' zł </p></td><td><p> '.$v['opis'].'</p></td><td><p>
                        
                        <button class="btn btn-primary btn-100" onclick = "deleteRecord(\'<p>Usuwam ubezpieczenie</p>\', \'ubez_sp\', \'id_uz\',\''.$v['id_uz'].'\',\'<p>Ubezpieczenie usunięte poprawnie</p>\',refreshTable)">Usuń</button>
                    
                        </p></td></tr>';
					
					//}
				}
				$st.='</tbody></table>';
				echo $st;
		?>