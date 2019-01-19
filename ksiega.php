<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_ksiega").addClass("active-link");
    }
</script>
<p></p>	
<?php
	$poczatek =1222812000;
	$dzis=strtotime(date("Y").'-'.date("m"));
	$miesiac=date("m");
	$rok=date("Y");
//	echo $poczatek.'<br>';
//	echo $dzis.'<br>';
//	echo $miesiac.'<br>';
//	echo $rok.'<br>';
//	echo strtotime(date("Y").'-'.date("m"));

$st='
        <table  class="table table-striped table-bordered table-hover"> 
            <thead><tr>
                <th width="70%">
                    <p>Za okres</p>
                </th>
                <th width="30%">
                </th>
            </tr></thead><tbody>';	
	while ($dzis>=$poczatek)
			{
					if ($miesiac==1)
							{
							$miesiac2='styczeń';
							}
					elseif ($miesiac==2)
							{
							$miesiac2='luty';
							}
					elseif ($miesiac==3)
							{
							$miesiac2='marzec';
							}		
					elseif ($miesiac==4)
							{
							$miesiac2='kwiecień';
							}
					elseif ($miesiac==5)
							{
							$miesiac2='maj';
							}
					elseif ($miesiac==6)
							{
							$miesiac2='czerwiec';
							}
					elseif ($miesiac==7)
							{
							$miesiac2='lipiec';
							}
					elseif ($miesiac==8)
							{
							$miesiac2='sierpień';
							}
					elseif ($miesiac==9)
							{
							$miesiac2='wrzesień';
							}
					elseif ($miesiac==10)
							{
							$miesiac2='październik';
							}
					elseif ($miesiac==11)
							{
							$miesiac2='listopad';
							}
					elseif ($miesiac==12)
							{
							$miesiac2='grudzień';
							}
			$st.='<tr><td><p>'.$miesiac2.' '.$rok.'</p></td><td><a href="drukuj_ksiega.php?m='.$miesiac.'&rok='.$rok.' " target="_blank"><p>Drukuj</p></a></td></tr>';
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

		