<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

        



?>

<form id="form_addstudent" role="form" action="<?php echo $_SERVER['PHP_SELF'];   ?>" method="post" enctype="multipart/form-data" >

<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
<!--        <div class="pull-right hidden-xs">
          <b>Version</b> 4.5 (Last Update 2020-02-24)
        </div>-->
<strong>Thank you for using ClassPAL by <a href="https://openapps.dev" target="_blank">OpenApps.Dev</a> | </strong><strong><a href="https://openapps.dev/licence/" target="_blank">License</a></strong>
</footer>


<!-- The Right Sidebar -->

</form> 



    </div><!-- ./wrapper -->

    

                <script> 
               // Add Studnet Attendence by using AJAX
               //This Ajax code will run select subject query. Page viewsubjallostudents.inc.inc.php
               // view_data - on the <button>
               // subject_id - id="<?php //echo que_que_id;  ?>" on the <button>
<?php
//$Today = date('Y-m-d');

?>
               $(document).ready(function(){  
                    $('.Mark_Stu_atten').click(function(){  
                         var StudentID = $(this).attr("id"); 
                         var SubjectID = <?php echo $_GET["SubjectID"]; ?>;
                         //var Today =  <?php //echo $Today; ?>;
                         //var SearchKey =  <?php //echo $_GET["SearchKey"]; ?>;
                         $.ajax({  
                              url:"fun/addatten.fn.aj.php",  
                              method:"get",  
                              data:{StudentID:StudentID, SubjectID:SubjectID},  
                              success:function(data){  
                                  //Swal alert will run
                                   swal({ type: 'success', title: 'Attendance Added Successfully', showConfirmButton: false, timer: 1500});
                              }  
                         });  
                    });  
               }); 
               
               </script> 
               
               
             <script> 
               // Add Studnet Absents by using AJAX
               //This Ajax code will run select subject query. Page viewsubjallostudents.inc.inc.php
               // view_data - on the <button>
               // subject_id - id="<?php //echo que_que_id;  ?>" on the <button>
<?php
//$Today = date('Y-m-d');

?>
               $(document).ready(function(){  
                    $('.Mark_Stu_absent').click(function(){  
                         var StudentID = $(this).attr("id"); 
                         var SubjectID = <?php echo $_GET["SubjectID"]; ?>;
                         //var Today =  <?php //echo $Today; ?>;
                         //var SearchKey =  <?php //echo $_GET["SearchKey"]; ?>;
                         $.ajax({  
                              url:"fun/addabsent.fn.aj.php",  
                              method:"get",  
                              data:{StudentID:StudentID, SubjectID:SubjectID},  
                              success:function(data){  
                                  //Swal alert will run
                                   swal({ type: 'success', title: 'Absent Added Successfully', showConfirmButton: false, timer: 1500});
                              }  
                         });  
                    });  
               }); 
               
               </script>
               
    
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script> 
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>

     <!-- Jquery Fullcalandar Class-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  
  

    
    <!-- Page script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>

<!--                     
<script>

$(document).ready(function() {
    $('#vas_table').DataTable( {
        "processing": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true
    } );
} );

</script>  -->
    
  </body>
</html>

 <?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}

      
?>