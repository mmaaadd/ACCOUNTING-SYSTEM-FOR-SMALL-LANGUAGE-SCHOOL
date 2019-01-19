<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_stawki").addClass("active-link");
    }
</script>	

<!--overlay for item edition-->
    <div id = "edit_overlay" class="save_overlay">
        <div class="panel panel-primary-edit">
            <div id="edit_overlay_body" class="panel-body">
                <table style="text-align: left;">
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa szkoly:
                            </td>
                            <td class="form_cell">
                                <?php
                                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                                            $arr=$db->GetArray($sql);
                                            //			print "<pre>";
                                            //			var_export($arr);
                                            //			print "</pre>";
                                                        //sort($arr);
                                            $st='<select class="form-control" name="nazwa_szkoly" id="nazwa_szkoly_edit" style="height:34px; width:100%; text-align: left;">';
                                            foreach($arr as $k=>$v){
                                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                                            }
                                            $st.='</select>';
                                            echo $st;
                                ?>
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Nazwa stawki:</h5>
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nazwa_stawki_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Opis na fakturze:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="tytul_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Czas:
                            </td>
                            <td class="form_cell">
                                <div class="input-group">
                                    <input  name="czas" type="text" onkeyup="cyfry(this);" class="form-control z-index-0" id="czas_edit">
                                    <span class="input-group-addon">min</span>
                                </div>                 
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Kwota:
                            </td>
                            <td class="form_cell">
                                <div class="input-group">
                                    <input  name="kwota" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control z-index-0" id="kwota_edit">
                                    <span class="input-group-addon">zł</span>
                                </div>                
                            </td>
                        </tr>   
                        <tr>
                           <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateRate()" style="width:350px" value='Zapisz'>
                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick='$("#edit_overlay").css("display","none") ' style="width:350px" value='Anuluj'>

                            </td>
                        </tr>           

                    </tbody>
                </table>  
                    <br>
                	<p><b>PAMIĘTAJ: Edytuj stawkę tylko jesli nie ma żadnych zajęć przypisanych do tej stawki.</b></p>
            </div>
        </div>
    </div>
 <!--[end] overlay for item edition-->

    <p></p>

<table style="text-align: left;">
    <tbody>
        <tr>
            <td class="form_cell_desc">
                Nazwa szkoly:
            </td>
            <td class="form_cell">
                <?php
                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                            $arr=$db->GetArray($sql);
                            //			print "<pre>";
                            //			var_export($arr);
                            //			print "</pre>";
                                        //sort($arr);
                            $st='<select class="chosen-select" name="nazwa_szkoly" id="nazwa_szkoly" style="height:34px; width:100%; text-align: left;">';
                            foreach($arr as $k=>$v){
                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                            }
                            $st.='</select>';
                            echo $st;
                ?>
            </td>
        </tr>	
        <tr>
            <td class="form_cell_desc">
                <h5>Nazwa stawki:</h5>
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="nazwa_stawki" type="text" >
            </td>
        </tr>
        <tr>
            <td class="form_cell_desc">
                Opis na fakturze:
            </td>
            <td class="form_cell">
                <input class = "form-control"  id="tytul" type="text" >
            </td>
        </tr>
        <tr>
            <td class="form_cell_desc">
                Czas:
            </td>
            <td class="form_cell">
                <div class="input-group">
                    <input  name="czas" type="text" onkeyup="cyfry(this);" class="form-control z-index-0" id="czas">
                    <span class="input-group-addon">min</span>
                </div>                 
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

            </td>
            <td class="form_cell">
                <input class="btn btn-primary" onclick="saveRate()" style="width:350px" value='Dodaj stawkę'>

            </td>
        </tr>           

    </tbody>
</table>
	
<hr>

<div id="rates_list">
</div>
	

		

<script>    
    
//get content for the table
	$(document).ready(function() {
		$(".chosen-select").chosen();
        refreshTable();
	} );
    
    function saveRate() {
        postParameters=({"nazwa_szkoly" : $("#nazwa_szkoly").val(), "nazwa_stawki":$("#nazwa_stawki").val(), "czas":$("#czas").val(), "kwota":$("#kwota").val(),"tytul":$("#tytul").val(),"n":5})  
        saveData("<p>Zapisuję stawkę</p>", postParameters,refreshTable)    
    }
    
    function refreshTable(){
         $.ajax({
            type: "POST",
            url: 'api/get_rates_table.php',
             dataType: "html",
            success: function(data) {
                $("#rates_list").empty();
                $("#rates_list").append(data);          
            },
            error: function() {
                $("#rates_list").empty() // clear content
                $("#rates_list").append("<p>Coś poszło nie tak, odśwież stronę.<p>")
            }
        });       
    }
    
    function showEditRateWindow(rateID){
        // rateID [int] - rate ID from database

        $.ajax({
            type: "POST",
            url: 'api/checkIfSchoolIsActiveRate.php',
            data: ({"ID":rateID}),
            dataType: "json",
            success: function(data) {
                if (data.aktywna==1){
                  
                    $("#nazwa_stawki_edit, #czas_edit, #kwota_edit, #tytul_edit").val("Wczytuję dane")
                    //$("nazwa_szkoly_edit_chosen").children(".chosen-single").html("<span>Wczytuję dane</span><div><b></b></div>")
                    //clear previous entries
                    $("#edit_overlay").css("display","block") // show overlay
                    $.ajax({
                        type: "POST",
                        url: 'api/getRateByID.php',
                        data: ({"ID":rateID}),
                        dataType: "json",
                        success: function(data) {
                                //$("#nazwa_szkoly_edit_chosen").children(".chosen-single").html("<span>"+data.nazwa+"</span><div><b></b></div>")
                                $("#nazwa_szkoly_edit").val(data.id_szkoly);
                                $("#nazwa_stawki_edit").val(data.nazwa_stawki);
                                $("#czas_edit").val(data.czas);
                                $("#kwota_edit").val(data.kwota);
                                $("#tytul_edit").val(data.tytul);
                                localStorage.setItem("rateID", rateID);
                                localStorage.setItem("rateStatus", data.aktywna);
                        },
                        error: function() {
                            $("#nazwa_szkoly_edit,#nazwa_stawki_edit, #czas_edit, #kwota_edit, #tytul_edit").val("Błąd, spróbuj ponownie.")
                        }
                    });                     
             
                }
                else{
                    $("#save_overlay").css("display","block") // show overlay
                    $("#save_overlay_body").empty() // clear content
                    //$("#save_overlay_body").append("Nie możesz edytować rachunku dla szkoły, która nie jest aktywna.") // show custom text 
                    $("#save_overlay_body").append("<p>Nie możesz edytować stawki dla szkoły, która nie jest aktywna.</p><button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
                }
                    
            },
            error: function() {
                    $("#save_overlay").css("display","block") // show overlay
                    $("#save_overlay_body").empty() // clear content
                     $("#save_overlay_body").append("<p>Nie udało się edytować stawki.</p><button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
            }
        });         
        
        

    }
    
    function updateRate(){
        $("#edit_overlay").css("display","none") // hide overlay
        postParameters = ({"id":localStorage.getItem("rateID"),"aktywna":localStorage.getItem("rateStatus"),"id_szkoly":$("#nazwa_szkoly_edit").val(),"nazwa_stawki": $("#nazwa_stawki_edit").val(), "czas": $("#czas_edit").val(),"kwota":$("#kwota_edit").val(),"tytul":$("#tytul_edit").val(),"n":10})
        saveData("Zapisuję zmiany", postParameters,refreshTable)        
    }
</script>
