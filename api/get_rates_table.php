<?php

    require("access_comp.php");

    $sql="select szkoly.nazwa,stawki.* from szkoly,stawki where stawki.id_szkoly=szkoly.id_szkoly order by stawki.aktywna desc, szkoly.nazwa asc";

        $arr=$db->GetArray($sql);
                    //sort($arr);	
                    //print "<pre>";
                    //var_export($arr);
                    //print "</pre>";

        $st='<table  class="table table-striped table-bordered table-hover">
                <thead>
                    <tr >
                        <th>
                            <p>Nazwa stawki</p>
                        </th>
                        <th>
                            <p>Tytułem</p>
                        </th>
                        <th>
                            <p>Nazwa szkoły </p>
                        </th>
                        <th>
                            <p>Czas</p>
                        </th>
                        <th>
                            <p>Kwota</p>
                        </th>
                        <th>
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
            ';
        foreach($arr as $k=>$v)
        {
            if ($v['aktywna']==0)
                {
                    $styl='style=\'color: darkgray; font-style: italic;\'';
                    $update= '<button class=\'btn btn-info btn-100\' onclick = "switchState(\''.$v['id_stawki'].'\',1,\'rate\',\'<p>Włączam stawkę</p>\',refreshTable)">Włącz</button>';                
                }
            else
                {
            
                    $styl='';
                    $update= '<button class=\'btn btn-primary btn-100\' onclick = "switchState(\''.$v['id_stawki'].'\',0,\'rate\',\'<p>Wyłączam stawkę</p>\',refreshTable)">Wyłącz</button>';           
                }

            //echo $styl;	
            $ts = strtotime($v['data']);
            //if ($ts>= $od && $ts<=$do){
                $st.='<tr ><td><p '.$styl.'>'.$v['nazwa_stawki'].'</p></td><td><p '.$styl.'>'.$v['tytul'].'</p></td><td><p '.$styl.'>  '.$v['nazwa'].' </p></td><td><p '.$styl.'> '.$v['czas'].' min </p></td><td><p '.$styl.'> '.$v['kwota'].' zł </p></td><td>'.$update."</td><td><button class='btn btn-primary btn-100' onclick = 'showEditRateWindow(".$v['id_stawki'].")'>Edytuj</button></td></tr>";

            //}
        }
        $st.='</tbody></table>';
        echo $st;
?>