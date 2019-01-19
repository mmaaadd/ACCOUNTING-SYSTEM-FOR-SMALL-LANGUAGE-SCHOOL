<div class='tabelka'>
	<table class='sample' width='650px'>
		<tbody>
			<tr>
				<td>
					<b>Nazwa usługi</b>
				</td>
				<td>
					<b>Ilość</b>
				</td>
				<td width='120px'>
					<b>Jednostka (min)</b>
				</td>				
				<td>
					<b>Cena</b>
				</td>
				<td>
					<b>Wartość</b><br>
					<?php
//zamiana od na miesiąc i rok					
					//echo $arr['0']['od'].'<br>';
					$time = $arr['0']['od'];
					$stamp = strtotime ($time);
					//echo $stamp.'<br>';
					$rok = date ('Y',$stamp);
					//echo $rok;
					$miesiac = date ('m',$stamp);
					if ($miesiac==1)
							{
							$miesiac='styczeń';
							}
					elseif ($miesiac==2)
							{
							$miesiac='luty';
							}
					elseif ($miesiac==3)
							{
							$miesiac='marzec';
							}		
					elseif ($miesiac==4)
							{
							$miesiac='kwiecień';
							}
					elseif ($miesiac==5)
							{
							$miesiac='maj';
							}
					elseif ($miesiac==6)
							{
							$miesiac='czerwiec';
							}
					elseif ($miesiac==7)
							{
							$miesiac='lipiec';
							}
					elseif ($miesiac==8)
							{
							$miesiac='sierpień';
							}
					elseif ($miesiac==9)
							{
							$miesiac='wrzesień';
							}
					elseif ($miesiac==10)
							{
							$miesiac='październik';
							}
					elseif ($miesiac==11)
							{
							$miesiac='listopad';
							}
					elseif ($miesiac==12)
							{
							$miesiac='grudzień';
							}
					//echo $miesiac;							
// koniec zamiany
					?>
				</td>				
			</tr>
			<?php
			if ($arr['0']['ilosc_1']!=0)
				{
				$kwota=$arr['0']['ilosc_1']*$arr['0']['cena_1'];
				echo '<tr><td>'.$arr['0']['tytul_1'].'<br>'.$miesiac.' '.$rok.'</td><td>'.$arr['0']['ilosc_1'].'</td><td>'.$arr['0']['minuty_1'].'</td><td>'.$arr['0']['cena_1'].' zł</td><td>'. number_format ( $kwota, 2 , ',', ' ').' zł</td></tr>';
				}
				
			if ($arr['0']['ilosc_2']!=0)
				{
				$kwota=$arr['0']['ilosc_2']*$arr['0']['cena_2'];
				echo '<tr><td>'.$arr['0']['tytul_2'].'<br>'.$miesiac.' '.$rok.'</td><td>'.$arr['0']['ilosc_2'].'</td><td>'.$arr['0']['minuty_2'].'</td><td>'.$arr['0']['cena_2'].' zł</td><td>'.number_format ( $kwota, 2 , ',', ' ').' zł</td></tr>';
				}	
			
			if ($arr['0']['ilosc_3']!=0)
				{
				$kwota=$arr['0']['ilosc_3']*$arr['0']['cena_3'];
				echo '<tr><td>'.$arr['0']['tytul_3'].'<br>'.$miesiac.' '.$rok.'</td><td>'.$arr['0']['ilosc_3'].'</td><td>'.$arr['0']['minuty_3'].'</td><td>'.$arr['0']['cena_3'].' zł</td><td>'.number_format ( $kwota, 2 , ',', ' ').' zł</td></tr>';
				}	
				
			if ($arr['0']['ilosc_4']!=0)
				{
				$kwota=$arr['0']['ilosc_4']*$arr['0']['cena_4'];
				echo '<tr><td>'.$arr['0']['tytul_4'].'<br>'.$miesiac.' '.$rok.'</td><td>'.$arr['0']['ilosc_4'].'</td><td>'.$arr['0']['minuty_4'].'</td><td>'.$arr['0']['cena_4'].' zł</td><td>'.number_format ( $kwota, 2 , ',', ' ').' zł</td></tr>';
				}	
				
			if ($arr['0']['ilosc_5']!=0)
				{
				$kwota=$arr['0']['ilosc_5']*$arr['0']['cena_5'];
				echo '<tr><td>'.$arr['0']['tytul_5'].'<br>'.$miesiac.' '.$rok.'</td><td>'.$arr['0']['ilosc_5'].'</td><td>'.$arr['0']['minuty_5'].'</td><td>'.$arr['0']['cena_5'].' zł</td><td>'.number_format ( $kwota, 2 , ',', ' ').' zł</td></tr>';
				}	
				?>
			<tr>
				<td colspan = 3></td>
				<td> <b> Razem:</b></td>
				<td><b>
				<?php echo number_format ( $arr['0']['kwota'], 2 , ',', ' ').' zł' ?>
				</b>
				</td>
				</td></tr>
		</tbody>
	</table>
	<br>
	<b>Do zapłaty: 
	<?php
		echo number_format ( $arr['0']['kwota'], 2 , ',', ' ').' zł';
	?>
	</b><br>
	Słownie: 
				<?php
					$slownie= slownie( $arr['0']['kwota']);
					echo $slownie;
				?>
	</br>
	</br>	
	<p >Zwolnienie od podatku od towarów i usług na podstawie art. 43 ust. 1 pkt 28</p>			
</div>

