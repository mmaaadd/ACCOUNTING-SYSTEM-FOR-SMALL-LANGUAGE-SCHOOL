<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/img/gd-usa.ico" type="image/x-icon" />
    <title>Księgowość</title>
    
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <!--jquery kalendarz-->
      <script src="assets/js/jquery-ui-1.11.2/jquery-ui.js"></script>
      <link rel="stylesheet" href="assets/js/jquery-ui-1.11.2/jquery-ui.theme.min.css">
      <link rel="stylesheet" href="assets/js/jquery-ui-1.11.2/jquery-ui.structure.min.css">	
      <link rel="stylesheet" href="assets/js/jquery-ui-1.11.2/jquery-ui.min.css">	
      <link rel="stylesheet" type="text/css" href="assets/js/DataTables-1.10.4/media/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="assets/js/DataTables-1.10.4/media/js/jquery.dataTables.min.js"> </script> 
      <script type="text/javascript" charset="utf8" src="assets/js/chosen_v1.6.2/chosen.jquery.js"> </script> 
      <link rel="stylesheet" href="assets/js/chosen_v1.6.2/chosen.css">	  
      <script>
      $(function() {
        $( ".SelectedDate" ).datepicker();
        $( ".SelectedDate" ).datepicker( "option", "firstDay", 1 );
        $( ".SelectedDate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
        //$( ".SelectedDate" ).datepicker( "option", "defaultDate", -30 );
        //$( "#datepicker" ).datepicker( "option", "showOtherMonths", true );
        //$( "#datepicker" ).datepicker( "option", "selectOtherMonths", true );
      });
      </script>
    <!--jquery kalendarz KONIEC-->  
    
    
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
       <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    
    
    <?php 
        require("api/access_comp.php");
	 ?>
    
  
    
</head>
    
<body>
    <!-- overlay --->
    <div id = "save_overlay" class="save_overlay">
        <div class="panel panel-primary">
            <div id="save_overlay_body" class="panel-body">
                <p>Trwa zapisywanie</p>
            </div>
        </div>
    
    </div> 
    <!-- end overlay --->   
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
        </div>
        <!-- /. NAV TOP  -->
        <?php
            include "navigationPanel.php"; //sidebar code
        ?>
        
        <div id="page-wrapper" >
          <div id="page-inner">
                <div class="row">
                    <div class="col-md-12" style="margin-top: 20px;">
                    <?php
                        //select page content [begin]

                        if(isset($_GET["id"])) {
                            //here will be options for the pages.
                            /*
                                no ID - dashboard
                                ID=1 - koszty
                                ID=2 - samochód
                                ID=3 - Sprzęt
                                ID=4 - Sklepy
                                ID=5 - Rachunki
                                ID=6 - Zajęcia
                                ID=7 - Stawki
                                ID=8 - Szkoły
                                ID=9 - wpisz podatek
                                ID=10 - Podatek do zapłaty
                                ID=11 - Księga
                                ID=12 - PIT
                                ID=13 - Ubezp. Społeczne
                                ID=14 - Ubezp. zdrowotne
                            */
                        switch ($_GET["id"]) {
                            case 1:
                                include "dodaj_koszty.php";
                                break;
                            case 2:
                                include "dodaj_koszty_sam.php";
                                break;
                            case 3:
                                include "sprzet.php";
                                break;
                            case 4:
                                include "dodaj_sklep.php";
                                break;
                            case 5:
                                include "rachunki.php";
                                break;  
                            case 6:
                                include "zajecia.php";
                                break;  
                            default:
                            case 7:
                                include "stawki.php";
                                break;  
                            case 8:
                                include "szkoly.php";
                                break;  
                            case 9:
                                include "wpisz_podatek.php";
                                break;  
                            case 10:
                                include "podatek.php";
                                break;         
                            case 11:
                                include "ksiega.php";
                                break;
                            case 12:
                                include "pit.php";
                                break;
                            case 13:
                                include "us.php";
                                break;
                            case 14:
                                include "uz.php";
                                break;
                            default:
                                include "dashboard.php";
                        }    



                        } else{
                            include "dashboard.php";
                        }




                        //select page content [end]
                    ?>
                    </div>
              </div>
            </div>
        </div>
        
        
        


        </div>
    <div class="footer">
      
    

        </div>
          

     <!-- /. WRAPPER  -->

    
   
</body>
</html>
