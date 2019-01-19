<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_sklepy").addClass("active-link");
    }
</script>	
	
<!--overlay for item edition-->
    <div id = "edit_overlay" class="save_overlay">
        <div class="panel panel-primary-edit">
            <div id="edit_overlay_body" class="panel-body">
                <table>
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Nazwa:</h5>
                            </td>
                            <td class="form_cell">
                                <input class = "form-control" name="nazwa_edit" id="nazwa_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Ulica:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control" name="ulica_edit" id="ulica_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Miejscowosc:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control" name="miejscowosc_edit" id="miejscowosc_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Kod pocztowy:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="kod_edit" onkeyup="cyfry_i_myslnik(this);" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateShop()" style="width:350px" value='Zapisz'>
                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick='$("#edit_overlay").css("display","none") ' style="width:350px" value='Anuluj'>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 <!--[end] overlay for item edition-->
<p></p>

	<table>
	<tbody>
		<tr>
			<td class="form_cell_desc">
				<h5>Nazwa:</h5>
			</td>
			<td class="form_cell">
				<input class = "form-control" name="nazwa" id="nazwa" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Ulica:
			</td>
			<td class="form_cell">
                <input class = "form-control" name="ulica" id="ulica" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Miejscowosc:
			</td>
			<td class="form_cell">
				<input class = "form-control" name="miejscowosc" id="miejscowosc" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Kod pocztowy:
			</td>
			<td class="form_cell">
				<input class = "form-control"  id="kod" onkeyup="cyfry_i_myslnik(this);" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">

			</td>
			<td class="form_cell">
                <input class="btn btn-primary" onclick="saveShop()" style="width:350px" value='Dodaj'>

			</td>
		</tr>
	</tbody>
	</table>
	<hr>

<table id="tablica_sklep" class="display" width="100%"> 
        <thead> 
            <tr >
                <th style="width:1500px">
                    <p><b>Nazwa sklepu</b></p>
                </th >
                <th style="width:1500px">
                    <p><b>Adres</b> </p>
                </th>
                <th style="width:500px">
                    &nbsp
                </th>
                <th style="width:500px">
                    &nbsp
                </th>
            </tr>
    </thead>
</table>

<script language="JavaScript">

    function saveShop() {
        postParameters=({"nazwa" : $("#nazwa").val(), "ulica":$("#ulica").val(), "miejscowosc":$("#miejscowosc").val(), kod:$("#kod").val(),n:3})  
        saveData("<p>Dodaję sklep</p>", postParameters,refreshTable)    
    }
    

    
    function showEditShopWindow(shopID){
        // shopID [int] - shop ID from database
        $("#nazwa_edit,#ulica_edit, #miejscowosc_edit, #kod_edit").val("Wczytuję dane") //clear previous entries
        $("#edit_overlay").css("display","block") // show overlay
        $.ajax({
            type: "POST",
            url: 'api/getShopByID.php',
            data: ({"ID":shopID}),
            dataType: "json",
            success: function(data) {
                    $("#nazwa_edit").val(data.nazwa);
                    $("#ulica_edit").val(data.ulica);
                    $("#miejscowosc_edit").val(data.miejscowosc);
                    $("#kod_edit").val(data.kod_pocztowy);
                    localStorage.setItem("shopID", shopID);
                    localStorage.setItem("shopStatus", data.aktywna);
            },
            error: function() {
                $("#nazwa_edit,#ulica_edit, #miejscowosc_edit, #kod_edit").val("Błąd, spróbuj ponownie.")
            }
        }); 
    }
    
    function updateShop(){
        $("#edit_overlay").css("display","none") // hide overlay
        postParameters = ({"id":localStorage.getItem("shopID"),"aktywna":localStorage.getItem("shopStatus"),"nazwa":$("#nazwa_edit").val(),"ulica": $("#ulica_edit").val(), "miejscowosc": $("#miejscowosc_edit").val(),"kod":$("#kod_edit").val(),"n":9})
        saveData("Zapisuję zmiany", postParameters,refreshTable)        
    }

    function refreshTable() {
        $("#tablica_sklep").DataTable().ajax.reload();
    }
    
	$(document).ready(function() {
		$('#tablica_sklep').DataTable({
			"order": [[ 0, "asc" ]],
			"serverSide": true,
			"ajax": "api/get_shops_list.php"
		});
		$('#tablica_sklep').css('display', 'block');
	} );

</script>	
		

		
