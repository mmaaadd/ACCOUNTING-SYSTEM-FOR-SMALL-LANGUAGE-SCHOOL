<?php
	//$numer = $_POST['n'] ;
	//echo '<META HTTP-EQUIV="Refresh" CONTENT="5";URL=http://www.ksiegowosc.the-gate.info/index.php?n='.$numer.'">';
//polaczenie z bazą danych 
require("access_comp.php");

include("adodb/adodb.php");
 
$numer = $_POST['n'] ; 
$error = 0;
switch ($numer)
	{
	case 1:
	//dodaj koszty
		$id= $_POST['sklep'];
		$opiss = $_POST['opis'];
		$ndk = $_POST['ndk'];
		$koszt = $_POST['koszt'];
		$data = $_POST['data'];
		$od = $_POST['od'];
		$do = $_POST['do'];
			
		//parametry do wpisania
		$tabela_docelowa='koszty';
		$parametry = 'Data, id_sklepu, ndk, opis,koszt';
		$wartosci="'$data','$id','$ndk','$opiss','$koszt'";

		//-------------dodawanie kosztu też do tabeli sprzęt
		if ( (isset ($_POST['sprzet'])) && ($_POST['sprzet']==1) )
			{
				mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
				mysql_select_db($baza_sql) or die(mysql_error());
				mysql_query("INSERT INTO sprzet (nazwa_sprzetu, data_zakupu, na_stanie, ndk) VALUES('".$opiss."','".$data."','1','".$ndk."') ") 
				or die(mysql_error());  
				$numer=903;
			}
		
	break;
	case 2:
	//dodaj zajecia
		$id= $_POST['stawka'];
		$opiss = $_POST['opis'];
		$ilosc = $_POST['ilosc'];
		$data = $_POST['data'];

		//parametry do wpisania
		$tabela_docelowa='zajecia';
		$parametry = 'data, id_stawki, opis, ilosc';
		$wartosci="'$data','$id','$opiss','$ilosc'";		
		
	break;
	case 3:
	//dodaj sklep
		$nazwa= $_POST['nazwa'];
		$ulica = $_POST['ulica'];
		$miejscowosc = $_POST['miejscowosc'];
		$kod = $_POST['kod'];
	
		//parametry do wpisania
		$tabela_docelowa=' sklepy';
		$parametry = 'nazwa, miejscowosc, ulica, kod_pocztowy';
		$wartosci="'$nazwa','$miejscowosc','$ulica','$kod'";	
	break;
	case 4:
	//dodaj szkołę
		$nazwa= $_POST['nazwa'];
		$ulica = $_POST['ulica'];
		$miejscowosc = $_POST['miejscowosc'];
		$kod = $_POST['kod'];
		$nip = $_POST['nip'];
		$regon = $_POST['regon'];
		
		//parametry do wpisania
		$tabela_docelowa=' szkoly';
		$parametry = 'nazwa, miejscowosc, ulica, kod_pocztowy, nip, regon';
		$wartosci="'$nazwa','$miejscowosc','$ulica','$kod','$nip','$regon'";		
	
	break;
	case 5:
	//dodaj stawki
		$id= $_POST['nazwa_szkoly'];
		$nazwa_stawki = $_POST['nazwa_stawki'];
		$czas = $_POST['czas'];
		$kwota = $_POST['kwota'];
		$tytul = $_POST['tytul'];
	
		//parametry do wpisania
		$tabela_docelowa='stawki';
		$parametry = 'id_szkoly, nazwa_stawki, kwota, czas, tytul';
		$wartosci="'$id','$nazwa_stawki','$kwota','$czas','$tytul'";	
	break;
	case 6:
	//dodaj podatek
		$data= $_POST['data'];
		$za_okres = $_POST['opis'];
		$koszt = $_POST['koszt'];
		
		//parametry do wpisania
		$tabela_docelowa=' podatek';
		$parametry = 'data_przelewu, za_okres, kwota';
		$wartosci="'$data','$za_okres','$koszt'";		
	break;
	case 7:
	//dodaj ubezpieczenie zdrowotne
		$data= $_POST['data'];
		$opis = $_POST['opis'];
		$kwota = $_POST['kwota'];
		
		//parametry do wpisania
		$tabela_docelowa=' ubez_zdr';
		$parametry = 'data_przelewu, kwota, opis';
		$wartosci="'$data','$kwota','$opis'";	
	break;
	case 8:
		$data= $_POST['data'];
		$opis = $_POST['opis'];
		$kwota = $_POST['kwota'];
		
		//parametry do wpisania
		$tabela_docelowa=' ubez_sp';
		$parametry = 'data_przelewu, kwota, opis';
		$wartosci="'$data','$kwota','$opis'";	
	break;
	//zapisz dane sklepu po edycji
	case 9:
		$id=$_POST['id'];
		$nazwa= $_POST['nazwa'];
		$ulica = $_POST['ulica'];
		$miejscowosc = $_POST['miejscowosc'];
		$kod = $_POST['kod'];
        $aktywna = $_POST['aktywna'];
	
		//parametry do wpisania
		$tabela_docelowa=' sklepy';
		$parametry = 'id_sklepu,nazwa, miejscowosc, ulica, kod_pocztowy, aktywna';
		$wartosci="'$id','$nazwa','$miejscowosc','$ulica','$kod','$aktywna'";	

			// laczenie do mysql login:root pass:madzia
			mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
			//echo "Connected to MySQL<br />";

			// laczenie z tabela "madzia_firma"
			mysql_select_db($baza_sql) or die(mysql_error());
			//echo "Connected to Database <br />";

			// Insert a row of information into the table "example"
			mysql_query("DELETE FROM sklepy WHERE id_sklepu='".$id."'") 
			or die(mysql_error());  
			//echo "Data Inserted!";		
	break;
	//zapis po edycji stawki
	case 10:
		$numer_id=$_POST['id'];
		$id_szkoly= $_POST['id_szkoly'];
		$nazwa_stawki = $_POST['nazwa_stawki'];
		$czas = $_POST['czas'];
		$kwota = $_POST['kwota'];
		$aktywna = $_POST['aktywna'];
		$tytul = $_POST['tytul'];
	
		//parametry do wpisania
		$tabela_docelowa='stawki';
		$parametry = 'id_stawki, id_szkoly, nazwa_stawki, kwota, czas, aktywna, tytul';
		$wartosci="'$numer_id','$id_szkoly','$nazwa_stawki','$kwota','$czas','$aktywna','$tytul'";	

			// laczenie do mysql login:root pass:madzia
			mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
			//echo "Connected to MySQL<br />";

			// laczenie z tabela "madzia_firma"
			mysql_select_db($baza_sql) or die(mysql_error());
			//echo "Connected to Database <br />";

			// Insert a row of information into the table "example"
			mysql_query("DELETE FROM stawki WHERE id_stawki='".$numer_id."'") 
			or die(mysql_error());  
			//echo "Data Inserted!";		
	break;
	//Zapis po edycji szkoły
	case 11:
		$id=$_POST['id'];
		$nazwa= $_POST['nazwa'];
		$ulica = $_POST['ulica'];
		$miejscowosc = $_POST['miejscowosc'];
		$kod = $_POST['kod'];
		$nip = $_POST['nip'];
		$regon = $_POST['regon'];
		$aktywna = $_POST['aktywna'];
		//parametry do wpisania
		$tabela_docelowa=' szkoly';
		$parametry = 'id_szkoly, nazwa, miejscowosc, ulica, kod_pocztowy, nip, regon, aktywna';
		$wartosci="'$id','$nazwa','$miejscowosc','$ulica','$kod','$nip','$regon','$aktywna'";	

			// laczenie do mysql login:root pass:madzia
			mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
			//echo "Connected to MySQL<br />";

			// laczenie z tabela "madzia_firma"
			mysql_select_db($baza_sql) or die(mysql_error());
			//echo "Connected to Database <br />";

			// Insert a row of information into the table "example"
			mysql_query("DELETE FROM szkoly WHERE id_szkoly='".$id."'") 
			or die(mysql_error());  
			//echo "Data Inserted!";		
	break;	
	case 19:
		$naglowek=$_POST['naglowek'];
		$miesiac= $_POST['miesiac'];
		$rok = $_POST['rok'];
		//parametry do wpisania
		$tabela_docelowa='t_naglowek';
		$parametry = 'nazwa';
		$wartosci="'$naglowek'";	
	break;	
		case 21:
	//dodaj koszty samochodu
		$id= $_POST['sklep'];
		$opiss = $_POST['opis'];
		$ndk = $_POST['ndk'];
		$koszt = $_POST['koszt'];
		$data = $_POST['data'];
		$od = $_POST['od'];
		$do = $_POST['do'];

		
		//parametry do wpisania
		$tabela_docelowa='koszty';
		$parametry = 'Data, id_sklepu, ndk, opis,koszt, sam';
		$wartosci="'$data','$id','$ndk','$opiss','$koszt','1'";

		//-------------dodawanie kosztu też do tabeli sprzęt
		if ( (isset ($_POST['sprzet'])) && ($_POST['sprzet']==1) )
			{
				mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
				mysql_select_db($baza_sql) or die(mysql_error());
				mysql_query("INSERT INTO sprzet (nazwa_sprzetu, data_zakupu, na_stanie, ndk) VALUES('".$opiss."','".$data."','1','".$ndk."') ") 
				or die(mysql_error());  
				$numer=904;
			}		

	break;
		case 22:
	//dodaj sprzet
		$opis= $_POST['opis_sprzetu'];
		$data_zakupu = $_POST['data_zakupu'];
		$ndk = $_POST['ndk'];
		
		//parametry do wpisania
		$tabela_docelowa='sprzet';
		$parametry = 'nazwa_sprzetu, data_zakupu, na_stanie, ndk ';
		$wartosci="'$opis','$data_zakupu','1','$ndk'";

	break;	
		case 23:
		
		$id=$_POST['id_sprzetu'];
		$data_zakupu= $_POST['data_zakupu'];
		$ndk = $_POST['ndk'];
		$opis = $_POST['opis'];
		$data_utylizacji = $_POST['data_utylizacji'];
		if ($data_utylizacji==Null)  //czy jest ustawiona data utylizacji?
		{
			$tabela_docelowa=' sprzet';
			$parametry = 'id_sprzetu, nazwa_sprzetu, data_zakupu, na_stanie, ndk';
			$wartosci="'$id','$opis','$data_zakupu','1','$ndk'";
			$numer=901;
		}
		else
		{
			$tabela_docelowa=' sprzet';
			$parametry = 'id_sprzetu, nazwa_sprzetu, data_zakupu, na_stanie, data_utylizacji, ndk';
			$wartosci="'$id','$opis','$data_zakupu','0', '$data_utylizacji', '$ndk'";
			$numer=902;
		}

			// laczenie do mysql login:root pass:madzia
			mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
			//echo "Connected to MySQL<br />";

			// laczenie z tabela "madzia_firma"
			mysql_select_db($baza_sql) or die(mysql_error());
			//echo "Connected to Database <br />";

			// Insert a row of information into the table "example"
			mysql_query("DELETE FROM sprzet WHERE id_sprzetu='".$id."'") ;
			//or die(mysql_error());  
			//echo "Data Inserted!";		
	break;	
		
		
	default:
		echo "<p><b>Coś poszło nie tak, dane nie zostały zapisane</b></p>";
        $error = 1;
	break;
	}

if ($error==0){
    // laczenie do mysql 
    mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
    //echo "Connected to MySQL<br />";

    // laczenie z tabela "madzia_firma"
    mysql_select_db($baza_sql) or die(mysql_error());
    //echo "Connected to Database <br />";

    // Insert a row of information into the table "example"
    
       
    if (mysql_query("INSERT INTO ".$tabela_docelowa." (".$parametry.") VALUES(".$wartosci.") ") ){
           if ($numer=='1')
            {
                echo '<p><b>Dodano koszt</b></p>';
                //echo "INSERT INTO ".$tabela_docelowa." (".$parametry.") VALUES(".$wartosci.") ";
                $n=1;
            }
        elseif ($numer=='2')
            {
                echo '<p><b>Dodano zajęcia</b></p>';
                $n=9;
            }	
        elseif ($numer=='3'||$numer=='9')
            {
                echo '<p><b>Zapisano sklep</b></p>';
                $n=3;
            }
        elseif ($numer=='4'||$numer=='11')
            {
                echo '<p><b>Zapisano szkołę</b></p>';
                $n=5;
            }	
        elseif ($numer=='5'||$numer=='10')
            {
                echo '<p><b>Zapisano stawkę</b></p>';
                $n=4;
            }
        elseif ($numer=='6')
            {
                echo '<p><b>Zapisano podatek</b></p>';
                $n=2;
            }
        elseif ($numer=='7')
            {
                echo '<p><b>Zapisano ubezpieczenie zdrowotne</b></p>';
                $n=7;
            }	
        elseif ($numer=='8')
            {
                echo '<p><b>Zapisano ubezpieczenie społeczne</b></p>';
                $n=6;
            }	
        elseif ($numer=='19')
            {
                echo '<p><b>Dodano kolumnę</b></p>';
                $n=19;
            }	
        elseif ($numer=='21')
            {
                echo '<p><b>Dodano koszt związany z samochodem</b></p>';
                $n=21;
            }	
        elseif ($numer=='22')
            {
                echo '<p><b>Dodano sprzęt</b></p>';
                $n=22;
            }
        elseif ($numer=='901')
            {
                echo '<p><b>Zapisano zmiany</b></p>';
                $n=22;
            }	
        elseif ($numer=='902')
            {
                echo '<p><b>Wycofano sprzęt</b></p>';
                $n=22;
            }
        elseif ($numer=='903')
            {
                echo '<p><b>Dodano koszt i sprzęt</b></p>';
                $n=1;
            }	
        elseif ($numer=='904')
            {
                echo '<p><b>Dodano koszt związany z samochodem i sprzęt</b></p>';
                $n=21;
            }		     
    }
    else{
        die(mysql_error()); 
        echo "<p><b>Zapis nieudany</b></p>";
    }
        
    
    
}

?>
