<div class='tabelka'>
	<table class='sample' width='650px'>
		<tbody>
			<tr>
				<td>
					<b>Nazwa usługi</b>
				</td>
				<td>
					<b>Kwota brutto</b><br>
				</td>				
			</tr>
			<?php
				$tytulem=$arr['0']['tytulem'];
				$kwota_netto=$arr['0']['kwota_netto'];
				$kwota_brutto=$arr['0']['kwota'];
				echo '<tr><td>'.$tytulem.'</td><td>'.number_format ( $kwota_brutto, 2 , ',', ' ').' zł</td></tr>';
			?>
			<tr>
				<td> <b> Razem:</b></td>
				<td>
					<b>
						<?php echo number_format ( $kwota_brutto, 2 , ',', ' ').' zł' ?>
					</b>
				</td>
		</tr>
		</tbody>
	</table>
	<br>
	<b>Do zapłaty: 
	<?php
		echo number_format ( $kwota_brutto, 2 , ',', ' ').' zł';
	?>
	</b><br>
	Słownie: 
				<?php
					$slownie= slownie( $kwota_brutto );
					echo $slownie;
				?>
	</br>
	</br>	
	<p >Zwolnienie od podatku od towarów i usług na podstawie art. 43 ust. 1 pkt 28</p>				
</div>

