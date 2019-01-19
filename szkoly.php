<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_szkoly").addClass("active-link");
    }
</script>		
<p></p>


<!--overlay for item edition-->
    <div id = "edit_overlay" class="save_overlay">
        <div class="panel panel-primary-edit">
            <div id="edit_overlay_body" class="panel-body">
                <table style="text-align: left;">
                     <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nazwa_edit" type="text" >
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Ulica:</h5>
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="ulica_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Miejscowość:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="miejscowosc_edit" type="text" >
                            </td>
                        </tr> 
                        <tr>
                            <td class="form_cell_desc">
                                Kod pocztowy:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="kod_edit" type="text" onkeyup="cyfry_i_myslnik(this);" >
                            </td>
                        </tr>  
                        <tr>
                            <td class="form_cell_desc">
                                NIP:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nip_edit" type="text" onkeyup="cyfry_i_myslnik(this);" >
                            </td>
                        </tr>  
                        <tr>
                            <td class="form_cell_desc">
                                REGON:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="regon_edit" type="text" onkeyup="cyfry_i_myslnik(this);" >
                            </td>
                        </tr>  
                        <tr>
                           <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateSchool()" style="width:350px" value='Zapisz'>
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


<table style="text-align: left;">
    <tbody>
        <tr>
            <td class="form_cell_desc">
                Nazwa:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="nazwa" type="text" >
            </td>
        </tr>	
        <tr>
            <td class="form_cell_desc">
                <h5>Ulica:</h5>
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="ulica" type="text" >
            </td>
        </tr>
        <tr>
            <td class="form_cell_desc">
                Miejscowość:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="miejscowosc" type="text" >
            </td>
        </tr> 
        <tr>
            <td class="form_cell_desc">
                Kod pocztowy:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="kod" type="text" onkeyup="cyfry_i_myslnik(this);" >
            </td>
        </tr>  
        <tr>
            <td class="form_cell_desc">
                NIP:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="nip" type="text" onkeyup="cyfry_i_myslnik(this);" >
            </td>
        </tr>  
        <tr>
            <td class="form_cell_desc">
                REGON:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="regon" type="text" onkeyup="cyfry_i_myslnik(this);" >
            </td>
        </tr>  
        <tr>
            <td class="form_cell_desc">

            </td>
            <td class="form_cell">
                <input class="btn btn-primary" onclick="saveSchool()" style="width:350px" value='Dodaj szkołę'>

            </td>
        </tr>           

    </tbody>
</table>
	
<hr>

<div id="schools_list">
</div>
		
<script>    
    
//get content for the table
	$(document).ready(function() {
        refreshTable();
	} );
    
    function saveSchool() {
        postParameters=({"nazwa" : $("#nazwa").val(), "ulica":$("#ulica").val(), "miejscowosc":$("#miejscowosc").val(), "kod":$("#kod").val(),"nip":$("#nip").val(),"regon":$("#regon").val(),"n":4})  
        saveData("<p>Zapisuję szkołę</p>", postParameters,refreshTable)    
    }
    
    function refreshTable(){
         $.ajax({
            type: "POST",
            url: 'api/get_schools_table.php',
             dataType: "html",
            success: function(data) {
                $("#schools_list").empty();
                $("#schools_list").append(data);          
            },
            error: function() {
                $("#schools_list").empty() // clear content
                $("#schools_list").append("<p>Coś poszło nie tak, odśwież stronę.<p>")
            }
        });       
    }
    
    function showEditSchoolWindow(schoolID){
        // schoolID [int] - school ID from database
        $("#nazwa_edit, #ulica_edit, #miejscowosc_edit, #kod_edit, #nip_edit, #regon_edit").val("Wczytuję dane")

        //clear previous entries
        $("#edit_overlay").css("display","block") // show overlay
        $.ajax({
            type: "POST",
            url: 'api/getSchoolByID.php',
            data: ({"ID":schoolID}),
            dataType: "json",
            success: function(data) {

                    $("#nazwa_edit").val(data.nazwa);
                    $("#ulica_edit").val(data.ulica);
                    $("#miejscowosc_edit").val(data.miejscowosc);
                    $("#kod_edit").val(data.kod_pocztowy);
                    $("#nip_edit").val(data.nip);
                    $("#regon_edit").val(data.regon);
                    localStorage.setItem("schoolID", schoolID);
                    localStorage.setItem("schoolStatus", data.aktywna);
            },
            error: function() {
                $("#nazwa_edit, #ulica_edit, #miejscowosc_edit, #kod_edit, #nip_edit, #regon_edit").val("Błąd, spróbuj ponownie.")
            }
        }); 
    }
    
    function updateSchool(){
        $("#edit_overlay").css("display","none") // hide overlay
        postParameters = ({"id":localStorage.getItem("schoolID"),"aktywna":localStorage.getItem("schoolStatus"),"nazwa":$("#nazwa_edit").val(),"ulica": $("#ulica_edit").val(), "miejscowosc": $("#miejscowosc_edit").val(),"kod":$("#kod_edit").val(),"nip":$("#nip_edit").val(),"regon":$("#regon_edit").val(),"n":11})
        saveData("Zapisuję zmiany", postParameters,refreshTable)        
    }    
</script>
