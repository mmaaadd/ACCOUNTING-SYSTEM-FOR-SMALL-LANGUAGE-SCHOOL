<?php

    require("access_comp.php");
    //$tabela='zajecia';
    //$parametr='data';
    //$nazwa_pola='stawka,ilosc';
    $sql="select nazwa,ulica,miejscowosc,kod_pocztowy,nip,regon,id_szkoly,aktywna from szkoly order by aktywna desc, nazwa asc";
        $arr=$db->GetArray($sql);
                    //sort($arr);	
                    //print "<pre>";
                    //var_export($arr);
                    //print "</pre>";

        $st='
        <table  class="table table-striped table-bordered table-hover"> 
            <thead>
                <tr >
                    <th width="30%">
                        <p>Nazwa sklepu</p>
                    </th>
                    <th width="30%">
                        <p>Adres </p>
                    </th>
                    <th width="20%">
                        <p>NIP/REGON</p>
                    </th>
                    <th width="10%">
                    </th>
                    <th width="10%">
                    </th>
                </tr>
            </thead><tbody>';
        foreach($arr as $k=>$v){
        //echo $v['aktywna'];
            if ($v['aktywna']==0)
                {
                    $styl='style=\'color: darkgray; font-style: italic;\'';
                    $update= '<button class=\'btn btn-info btn-100\' onclick = "switchState(\''.$v['id_szkoly'].'\',1,\'school\',\'<p>Włączam szkołę</p>\',refreshTable)">Włącz</button>';    
                }
            else
                {
                    $styl='';
                    $update= '<button class=\'btn btn-primary btn-100\' onclick = "switchState(\''.$v['id_szkoly'].'\',0,\'school\',\'<p>Wyłączam szkołę</p>\',refreshTable)">Wyłącz</button>';  
                }
            //$update= '<form action="process_aktywuj.php" method="post"><input type="hidden" name="id" value="'.$v['id_szkoly'].'"><input type="hidden" name="tabela" value="szkoly"><input type="hidden" name="kolumna" value="id_szkoly"><input type="hidden" name="aktywna" value="'.$aktywna_zmien.'"><input type="image" src='.$ikona.'></form>';
            $ts = strtotime($v['data']);
            //if ($ts>= $od && $ts<=$do){
                $st.='<tr ><td><p '.$styl.'>'.$v['nazwa'].'</p></td><td width="170px"><p '.$styl.'>  '.$v['ulica'].'<br>'.$v['kod_pocztowy'].' '.$v['miejscowosc'].' </p></td><td width="120px"><p '.$styl.'> NIP: '.$v['nip'].'<br>REGON:'.$v['regon'].'</p></td><td>'.$update."</td><td><button class='btn btn-primary btn-100' onclick = 'showEditSchoolWindow(".$v['id_szkoly'].")'>Edytuj</button></td></tr>";

            //}
        }
        $st.='</tbody></table>';
        echo $st;
?>
		