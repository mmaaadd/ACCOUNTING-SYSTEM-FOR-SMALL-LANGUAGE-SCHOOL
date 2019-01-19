
 <?php
        require("access_comp.php");
		$id_szko= $_POST['nazwa_szkoly'];
	 	$d_wyst= $_POST['data_wystawienia'];
		$d_dost = $_POST['data_dostarczenia'];
		$termin_platnosci = $_POST['termin_platnosci'];
		$n_rach = $_POST['nr_rachunku'];
		$kwota_netto = $_POST['kwota_netto'];
		$kwota_brutto = $_POST['kwota_brutto'];
		$tytulem = $_POST['tytulem'];




        $insert= "INSERT INTO rachunek (id_szkoly, data_wystawienia, data_dostarczenia, termin_platnosci, nr_rachunku,  kwota, kwota_netto, za_etat, tytulem)  VALUES(".$id_szko.', "'.$d_wyst.'", "'.$d_dost.'", "'.$termin_platnosci.'", "'.$n_rach.'", "'.$kwota_brutto.'", "'.$kwota_netto.'", 1, "'.$tytulem.'") ';


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