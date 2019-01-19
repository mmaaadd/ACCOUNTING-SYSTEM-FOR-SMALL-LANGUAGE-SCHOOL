<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_wpisz_pod").addClass("active-link");
    }
</script>
	<div id="spiffycalendar" class="text"></div>
    <p></p>
	<table>
        <tbody>
            <tr>
                <td class="form_cell_desc">
                    <h5>Data przelewu:</h5>
                </td>
                <td class="form_cell">
                    <input name="data" type="text"  id="data" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >

                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">
                    Kwota:
                </td>
                <td class="form_cell">                        
                    <div class="input-group">
                        <input  name="kwota" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control z-index-0" id="kwota">
                        <span class="input-group-addon">zł</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">
                    Za okres:
                </td>
                <td class="form_cell">
                    <?php
                            $poczatek = 1262300400;
                            $dzis=strtotime(date("Y").'-'.date("m"));
                            $miesiac=date("m");
                            $rok=date("Y");

                            $st='<select class="chosen-select" id="za_okres" style="height:34px; width:100%">';
                            while ($dzis>=$poczatek)
                                {
                                $st.='<option>'.$rok.'-'.$miesiac.'-01</option>';
                                if ($miesiac!=1)
                                    {
                                    $miesiac=$miesiac-1;
                                    if ($miesiac<10){
                                        $miesiac = "0".$miesiac;
                                    }

                                    }
                                else
                                    {
                                    $miesiac=12;
                                    $rok=$rok-1;
                                    }
                                $dzis=strtotime($rok.'-'.$miesiac);
                                }
                            $st.='</select>';
                            echo $st.'<br>';
                    ?>
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">

                </td>
                <td class="form_cell">
                    <input class="btn btn-primary" onclick="saveTax()" style="width:350px" value='Dodaj'>
                </td>
            </tr>
        </tbody>
	</table>

<hr>


  
<table id="tablica_podatek" class="display" >
    <thead> 
        <tr>
            <th width="1000px">
                    <p><b>Za okres</b></p>
            </th>
            <th width="1000px">
                <p><b>Data przelewu</b> </p>
            </th>
            <th width="1000px">
                <p> <b>Kwota</b> </p>
            </th>
            <th width="1000px">
            </th>
        </tr>
    </thead>
</table>

<script language="JavaScript">

	$(document).ready(function() {
        $(".chosen-select").chosen();
		$('#tablica_podatek').DataTable({
			"order": [[ 0, "desc" ]],
			"serverSide": true,
			"ajax": "api/get_tax_list.php"
		});
		$('#tablica_podatek').css('display', 'block');
	} );

    function saveTax() {
        postParameters=({"data" : $("#data").val(), "opis":$("#za_okres").val(), "koszt":$("#kwota").val(),"n":6})  
        saveData("<p>Zapisuję podatek</p>", postParameters,refreshTable)    
    }
   function refreshTable() {
        $("#tablica_podatek").DataTable().ajax.reload();
    }
</script>	

