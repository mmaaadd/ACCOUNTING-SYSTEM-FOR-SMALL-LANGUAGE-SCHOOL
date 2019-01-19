	<?php
            require("access_comp.php");
			$tabela='zajecia';
			$parametr='data';
			$nazwa_pola='stawka,ilosc';
			$sql="select rachunek.data_wystawienia, rachunek.nr_rachunku, rachunek.kwota, rachunek.id_rachunku, rachunek.za_etat, szkoly.nazwa from rachunek,szkoly where rachunek.id_szkoly=szkoly.id_szkoly";
				$arr=$db->GetArray($sql);
							//print "<pre>";
							//var_export($arr);
							//print "</pre>";
				rsort($arr);			
				$st='
                <table  class="table table-striped table-bordered table-hover"> 
                    <thead>
                        <tr >
                            <th width="10%">
                                <p><b>Nr rach.</b></p>
                            </th>
                            <th width="10%">
                                <p> <b>Data wyst.</b> </p>
                            </th>
                            <th width="10%">
                                <p><b>Kwota</b></p>
                            </th>
                            <th width="35%">
                                <p><b>Nazwa szkoły</b></p>
                            </th>
                            <th width="10%">
                            </th>
                            <th width="10%"> 
                            </th>
                            <th width="15%"> 
                            </th>
                        </tr>
                    </thead><tbody>';
				foreach($arr as $k=>$v){
					$ts = strtotime($v['data']);
					//if ($ts>= $od && $ts<=$do){
						$st.='
                        <tr >
                            <td>
                                <p>'.$v['nr_rachunku'].'</p>
                            </td>
                            <td>
                                <p>  '.$v['data_wystawienia'].' </p>
                            </td>
                            <td>
                                <p> '.$v['kwota'].' zł </p>
                            </td>
                            <td>
                                <p> '.$v['nazwa'].'</p>
                            </td>
                            <td>
                                        <button class="btn btn-primary btn-100" onclick = "showInvoiceEditWindow('.$v['id_rachunku'].','.$v['za_etat'].')">Edytuj</button>
                            </td>
                            <td>
                                        <button class="btn btn-primary btn-100" onclick = "deleteRecord(\'<p>Usuwam rachunek</p>\', \'rachunek\', \'id_rachunku\',\''.$v['id_rachunku'].'\',\'<p>Rachunek usunięty poprawnie</p>\',getInvoiceTable)">Usuń</button>
                            </td>
                            <td>
                                <a href="drukuj_rach.php?id='.$v['id_rachunku'].'&podpis=0'.' " target="_blank"><p>Drukuj</p></a><a href="drukuj_rach.php?id='.$v['id_rachunku'].'&podpis=1'.' " target="_blank">
                                    <p>Drukuj z podpisem</p>
                                </a>
                            </td>
                        </tr>';
					
					//}
				}
				$st.='</tbody></table>';
				echo $st;
		?>