<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_pod_do_z").addClass("active-link");
    }
</script>		
<p></p>

<div id="tax_list">
</div>

<script>    
    
//get content for the table
	$(document).ready(function() {
        refreshTable();
	} );
    
     function refreshTable(){
         $.ajax({
            type: "POST",
            url: 'api/get_tax_table.php',
             dataType: "html",
            success: function(data) {
                $("#tax_list").empty();
                $("#tax_list").append(data);          
            },
            error: function() {
                $("#tax_list").empty() // clear content
                $("#tax_list").append("<p>Coś poszło nie tak, odśwież stronę.<p>")
            }
        });       
    }   
    
</script>
