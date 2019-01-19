 <?php
    require("access_comp.php");

    $id_szko= $_POST['nazwa_szkoly'];
    $d_wyst= $_POST['data_wystawienia'];
    $d_dost = $_POST['data_dostarczenia'];
    $termin_platnosci= $_POST['termin_platnosci'];
    $n_rach = $_POST['nr_rachunku'];
    $od = $_POST['data_od'];
    $do = $_POST['data_do'];


//-----------pobranie stawek dla szkoly (tablica $stawki)-----------------------------
        $sql="select distinct * from stawki where aktywna = 1 and id_szkoly=".$id_szko;
        $stawki=$db->GetArray($sql);
            //print "<pre>";
            //var_export($stawki);
            //print "</pre>";
//----------tablica $stawki pobrana --------------------------------------------------	

//-------- pobranie tablicy wszystkich zajęć o id stawki pasującym do szkoły i z zakresu dat od - do 
//--------(tablica $wszystkie)--------------------------------------------------------
        $sql='select * from zajecia, (select distinct * from stawki where id_szkoly='.$id_szko.') as foo where zajecia.id_stawki=foo.id_stawki and zajecia.data>="'.$od.'" and zajecia.data<="'.$do.'"';
        $wszystkie=$db->GetArray($sql);
        //print "<pre>";
        //	var_export($wszystkie);
        //	print "</pre>";
        //print_r($wszystkie);
//---------pobrane wszystkie zajęcia z wybranego zakresu i z wybranymi stawkami---------

        $i=0;
        $kwota_rach=0;
          foreach ( $stawki as $s )
              {
                $suma[$i]=0;
                $zmienna=$stawki[$i]['id_stawki'];
                $cena[$i]=$stawki[$i]['kwota'];
                $minuty[$i]=$stawki[$i]['czas'];
                $tytul[$i]=$stawki[$i]['tytul'];
                //echo $zmienna.'<br>';
                $sql='select * from zajecia where zajecia.id_stawki='.$zmienna.' and zajecia.data>="'.$od.'" and zajecia.data<="'.$do.'"';
                //echo $sql;
                $dla_stawki=$db->GetArray($sql);
                $j=0;
                 foreach ( $dla_stawki as $d )
                    {
                    $ilosc=$dla_stawki[$j]['ilosc'];
                    $suma[$i]=$suma[$i]+$ilosc;
                    $j=$j+1;
                    }
                $kwota[$i]= $suma[$i]*$cena[$i];
                $kwota_rach=$kwota_rach+$kwota[$i];
                $i=$i+1;
              }

    //-------zapis do bazy----------------------------------------------------
        //------przygotowanie wyrazenia--------------------

        $insert= "INSERT INTO rachunek (id_szkoly, data_wystawienia, data_dostarczenia, termin_platnosci, nr_rachunku, od, do, tytul_1, minuty_1, cena_1, ilosc_1, tytul_2, minuty_2, cena_2, ilosc_2, tytul_3, minuty_3, cena_3, ilosc_3, tytul_4, minuty_4, cena_4, ilosc_4, tytul_5, minuty_5, cena_5, ilosc_5, kwota)  VALUES(".$id_szko.', "'.$d_wyst.'", "'.$d_dost.'", "'.$termin_platnosci.'", "'.$n_rach.'", "'.$od.'", "'.$do.'", ';


        for($k = 0; $k < $i; $k++)
        {
            $insert=$insert.'"'.$tytul[$k].'", '.$minuty[$k].', '.$cena[$k].', '.$suma[$k].', ';	
        }
        //echo $insert.' <br>';

        $i=5-$i;

        for($k = 0; $k < $i; $k++)
        {
            $insert=$insert.'"",0,0,0,';	
        }
        //echo $insert.' <br>';

        $insert=$insert.$kwota_rach.');';

//										echo $insert.' <br>';

        //----------wyrazenie gotowe--------------------------------
        //----------polaczenie i zapis do bazy----------------------

        mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
        //echo "Connected to MySQL<br />";

        // laczenie z tabela "madzia_firma"
        mysql_select_db($baza_sql) or die(mysql_error());
        //echo "Connected to Database <br />";

        if (!empty($_POST["ID_rachunku"]) && is_numeric($_POST["ID_rachunku"])) {
             
            if (mysql_query("DELETE FROM rachunek WHERE id_rachunku='".$_POST["ID_rachunku"]."'")){
                // Insert a row of information into the table "example"
                if (mysql_query($insert)){
                    echo "<p>Zmieniono rachunek</p>";    
                } else{
                    echo "<p>Zapis nieudany</p>";
                }   
            } else{
                echo "<p>Zapis nieudany</p>";
            }   
        } else {
            // Insert a row of information into the table "example"
            if (mysql_query($insert)){
                echo "<p>Dodano rachunek</p>";    
            } else{
                echo "<p>Zapis nieudany</p>";
            }            
        }
?>	
