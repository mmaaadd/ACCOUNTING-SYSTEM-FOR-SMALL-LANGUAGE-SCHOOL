 <?php
 require("access_comp.php");
 $numer = $_POST['n'] ;
 $tabela = $_POST['tabela'];
 $parametr = $_POST['parametr'];
 $success = $_POST['succesMsg'];

// laczenie do mysql 
mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
//echo "Connected to MySQL<br />";

// laczenie z tabela "madzia_firma"
mysql_select_db($baza_sql) or die(mysql_error());
if (mysql_query("DELETE FROM ".$tabela." WHERE ".$parametr."=".$numer.";")){
    echo $success;
} else {
    echo "<p><b>Nie udało się usunąć wpisu.</b></p>";
    echo "DELETE FROM ".$tabela." WHERE ".$parametr."=".$numer.";";
}
?>

