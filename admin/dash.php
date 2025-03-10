<?php


//ini_set('display_errors', '1'); 


// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];


//includes Files
include_once 'php-includes/connect.inc.php';
include_once 'php-includes/header.inc.php';
include_once 'php-includes/topnav.inc.php';
include_once 'php-includes/get-var.inc.php';
include_once 'php-includes/sidebarleft.inc.php';



// Function Files
include_once 'fun/addstudent.fn.php';
include_once 'fun/updatestudentdetils.fn.php';
include_once 'fun/addpayment.fn.php';
include_once 'fun/studentattendance.fn.php';
include_once 'fun/subjectallocation.fn.php';
include_once 'fun/updatesubject.fn.php';
include_once 'fun/adduser.fn.php';
include_once 'fun/updateuser.fn.php';
include_once 'fun/announcement.fn.php';
include_once 'fun/updateannouncement.fn.php';
include_once 'fun/addnotes.fn.php';
include_once 'fun/updatenotes.fn.php';
include_once 'fun/changebnumber.fn.php';
include_once 'fun/user_quick_notes.fn.php';


//linked with user_quick_motes.fn.php
$Update_Quick_Notes = updateQuicknotes();


$stmt_permission_1121 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1121" );
$stmt_permission_1121->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt_permission_1121->execute();

while ($stmt_permission_1121->fetch()){

}


?>

<?php




?>




      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php

    if ($cp_userpermission_OnOff == 0){

        $Message = "<h1>";
        $Message .= "Welcome $FirstName...!!";
        $Message .= "</h1>";
        echo $Message;

    } else {


?>
            <h1>

            Dashboard

       <?php

       ?>

            <small>Hi.. <?php echo $FirstName ?>, Welcome to ClassPAL Super Admin Area..!!</small>


            <?php
            ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
             <?php
           
               $Date2 = date('Y-m-d');
            
               // To get monthly income...
               $stmt_todayincome = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate LIKE  ?");
               $stmt_todayincome->bind_param("s", $Date2 );
               $stmt_todayincome->bind_result($TodayIncome);
               $stmt_todayincome->execute();

               while ($stmt_todayincome->fetch()){
               $TodayIncome = number_format($TodayIncome, 2, '.', '');  
                   
            }

            ?>

            <div style="<?php ?>" class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Today Income</span>
                  <span class="info-box-number">Rs. <?php echo $TodayIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->


            <?php

               $Date_month_start = date('Y-m-01');
               $Date_month_End = date('Y-m-d');

               // To get This Month Income...
               $stmt_ThisMonthIncome = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_ThisMonthIncome->bind_param("ss", $Date_month_start, $Date_month_End );
               $stmt_ThisMonthIncome->bind_result($ThisMonthIncome);
               $stmt_ThisMonthIncome->execute();

               while ($stmt_ThisMonthIncome->fetch()){
               $MonthIncome = number_format($MonthIncome, 2, '.', '');

            }

            
              //JAN-----------------------------------------------
              $Date_month_start_JAN =  date('Y-01-01');
              $Date_month_End_JAN =  date('Y-01-31');

               // To get monthly income...
               $stmt_JAN = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_JAN->bind_param("ss", $Date_month_start_JAN, $Date_month_End_JAN );
               $stmt_JAN->bind_result($MonthIncome_JAN);
               $stmt_JAN->execute();

               while ($stmt_JAN->fetch()){
               $MonthIncome_JAN = number_format($MonthIncome_JAN, 2, '.', '');

                }
              //JAN-----------------------------------------------

                

               //FEB----------------------------------------------- 
               $Date_month_start_FEB =  date('Y-02-01');
               $Date_month_End_FEB =  date('Y-02-29');

               // To get monthly income...
               $stmt_FEB = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_FEB->bind_param("ss", $Date_month_start_FEB, $Date_month_End_FEB );
               $stmt_FEB->bind_result($MonthIncome_FEB);
               $stmt_FEB->execute();

               while ($stmt_FEB->fetch()){
               $MonthIncome_FEB = number_format($MonthIncome_FEB, 2, '.', '');

               }
               //FEB-----------------------------------------------
               
               
               //MAR-----------------------------------------------
               $Date_month_start_MAR =  date('Y-03-01');
               $Date_month_End_MAR =  date('Y-03-31');

               // To get monthly income...
               $stmt_MAR = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_MAR->bind_param("ss", $Date_month_start_MAR, $Date_month_End_MAR );
               $stmt_MAR->bind_result($MonthIncome_MAR);
               $stmt_MAR->execute();

               while ($stmt_MAR->fetch()){
               $MonthIncome_MAR = number_format($MonthIncome_MAR, 2, '.', '');

                }
              //MAR-----------------------------------------------
                
                
               //APR-----------------------------------------------
               $Date_month_start_APR =  date('Y-04-01');
               $Date_month_End_APR =  date('Y-04-30');

               // To get monthly income...
               $stmt_APR  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_APR->bind_param("ss", $Date_month_start_APR, $Date_month_End_APR );
               $stmt_APR ->bind_result($MonthIncome_APR);
               $stmt_APR ->execute();

               while ($stmt_APR ->fetch()){
               $MonthIncome_APR = number_format($MonthIncome_APR, 2, '.', '');

                }
              //APR-----------------------------------------------   
                
                
               //MAY-----------------------------------------------
               $Date_month_start_MAY =  date('Y-05-01');
               $Date_month_End_MAY =  date('Y-05-31');

               // To get monthly income...
               $stmt_MAY  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_MAY->bind_param("ss", $Date_month_start_MAY, $Date_month_End_MAY );
               $stmt_MAY ->bind_result($MonthIncome_MAY);
               $stmt_MAY ->execute();

               while ($stmt_MAY ->fetch()){
               $MonthIncome_MAY = number_format($MonthIncome_MAY, 2, '.', '');

                }
              //MAY-----------------------------------------------                 
                
               //JUN-----------------------------------------------
               $Date_month_start_JUN =  date('Y-06-01');
               $Date_month_End_JUN =  date('Y-06-30');

               // To get monthly income...
               $stmt_JUN  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_JUN->bind_param("ss", $Date_month_start_JUN, $Date_month_End_JUN );
               $stmt_JUN ->bind_result($MonthIncome_JUN);
               $stmt_JUN ->execute();

               while ($stmt_JUN ->fetch()){
               $MonthIncome_JUN = number_format($MonthIncome_JUN, 2, '.', '');

                }
              //JUN-----------------------------------------------
                
                
               //JLY-----------------------------------------------
               $Date_month_start_JLY =  date('Y-07-01');
               $Date_month_End_JLY =  date('Y-07-30');

               // To get monthly income...
               $stmt_JLY  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_JLY->bind_param("ss", $Date_month_start_JLY, $Date_month_End_JLY );
               $stmt_JLY ->bind_result($MonthIncome_JLY);
               $stmt_JLY ->execute();

               while ($stmt_JLY ->fetch()){
               $MonthIncome_JLY = number_format($MonthIncome_JLY, 2, '.', '');

                }
              //JLY-----------------------------------------------                
                
               //AUG-----------------------------------------------
               $Date_month_start_AUG =  date('Y-08-01');
               $Date_month_End_AUG =  date('Y-08-31');

               // To get monthly income...
               $stmt_AUG  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_AUG->bind_param("ss", $Date_month_start_AUG, $Date_month_End_AUG );
               $stmt_AUG ->bind_result($MonthIncome_AUG);
               $stmt_AUG ->execute();

               while ($stmt_AUG ->fetch()){
               $MonthIncome_AUG = number_format($MonthIncome_AUG, 2, '.', '');

                }
              //AUG-----------------------------------------------

               //SEP-----------------------------------------------
               $Date_month_start_SEP =  date('Y-09-01');
               $Date_month_End_SEP =  date('Y-09-30');

               // To get monthly income...
               $stmt_SEP  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_SEP->bind_param("ss", $Date_month_start_SEP, $Date_month_End_SEP );
               $stmt_SEP ->bind_result($MonthIncome_SEP);
               $stmt_SEP ->execute();

               while ($stmt_SEP ->fetch()){
               $MonthIncome_SEP = number_format($MonthIncome_SEP, 2, '.', '');

                }
              //SEP-----------------------------------------------

               //OCT-----------------------------------------------
               $Date_month_start_OCT =  date('Y-10-01');
               $Date_month_End_OCT =  date('Y-10-31');

               // To get monthly income...
               $stmt_OCT  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_OCT->bind_param("ss", $Date_month_start_OCT, $Date_month_End_OCT );
               $stmt_OCT ->bind_result($MonthIncome_OCT);
               $stmt_OCT ->execute();

               while ($stmt_OCT ->fetch()){
               $MonthIncome_OCT = number_format($MonthIncome_OCT, 2, '.', '');

                }
              //OCT-----------------------------------------------        
                
                
               //NOV-----------------------------------------------
               $Date_month_start_NOV =  date('Y-11-01');
               $Date_month_End_NOV =  date('Y-11-30');

               // To get monthly income...
               $stmt_NOV  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_NOV->bind_param("ss", $Date_month_start_NOV, $Date_month_End_NOV );
               $stmt_NOV ->bind_result($MonthIncome_NOV);
               $stmt_NOV ->execute();

               while ($stmt_NOV ->fetch()){
               $MonthIncome_NOV = number_format($MonthIncome_NOV, 2, '.', '');

                }
              //NOV-----------------------------------------------                  
 
                
               //DEC-----------------------------------------------
               $Date_month_start_DEC =  date('Y-12-01');
               $Date_month_End_DEC =  date('Y-12-31');

               // To get monthly income...
               $stmt_DEC  = $db->prepare("SELECT SUM(pay_cos_total + pay_misc_amount) FROM cp_payments WHERE pay_paymentdate BETWEEN ? AND ?");
               $stmt_DEC->bind_param("ss", $Date_month_start_DEC, $Date_month_End_DEC );
               $stmt_DEC ->bind_result($MonthIncome_DEC);
               $stmt_DEC ->execute();

               while ($stmt_DEC ->fetch()){
               $MonthIncome_DEC = number_format($MonthIncome_DEC, 2, '.', '');

                }
              //DEC-----------------------------------------------                 
                
                
            ?>

            <div style=" " class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This Month Income</span>
                  <span class="info-box-number">Rs. <?php echo $ThisMonthIncome; ?></span>
                  <span class="info-box-text">From: <?php echo $Date_month_start; ?> To: <?php echo $Date_month_End; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

<div class="row">
        <div class="col-lg-3 col-md-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 style="font-size: 30px;" >Add Student</h3>

              <p>Add New Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="index.php?page=AddStudents" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                <h3 style="font-size: 30px;">Add Attendance</h3>

              <p>Mark Your Student Attendance</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="index.php?page=StudentAttendance" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 style="font-size: 30px;">Add Payments</h3>

              <p>You can add payments </p>
            </div>
            <div class="icon">
              <i class="fa fa-usd"></i>
            </div>
            <a href="index.php?page=AddStudentPayments" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-md-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 style="font-size: 30px;">Reports</h3>

              <p>Analyse your Class with Reports</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="index.php?page=Reports" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        

       
        
       <div class="col-lg-3 col-md-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 style="font-size: 30px;" >All Allo.Students</h3>

              <p>View all allowcated students</p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="index.php?page=ViewAllAllowStudents" class="small-box-footer">
              Click Here <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>      
        
       <div class="col-lg-3 col-md-12 col-xs-12">

        </div>        
        
        <!-- ./col -->
      </div>

          <div style=" " class="row">
            <div class="col-md-12">

                <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">MONTHLY INCOME CHART</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body" style="display: block;">
                  <div class="chart">
                    <canvas id="barChart" style="height: 284px; width: 601px;" width="601" height="284"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div>




            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->


              <div class="row">
                <div class="col-md-12">
                    
<?php

    $quick_user_notes = $_SESSION['user_id'];
    
    
    //This will show user quick notes
    $stmtSelect_user_notes = $db->prepare("SELECT user_notes FROM `cp_users` WHERE `id`= ?" );
    $stmtSelect_user_notes->bind_param("i", $quick_user_notes );
    $stmtSelect_user_notes->bind_result($Select_user_notes);
    $stmtSelect_user_notes->execute();    
    
    while ($stmtSelect_user_notes->fetch()){
        
    }
                                         
                                         
?>

                    
          <form id="form_user_notes" name="form_User_notes"  role="form" action="" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                      <label>User Quick Notes</label>
                      <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-pencil "></i>
                      </div>                       
                      <textarea class="form-control" name="txt_user_notes" rows="10"><?php echo $Select_user_notes; ?></textarea>
                      
                        <input  style="margin-top: 5px;" class="btn btn-flat btn-success" name="btn_AddNote_submit" type="submit" onclick="" value="Update">                        
                      </div>
                   </div>
                 </form>  
                    

                    
                  
                    
                </div><!-- /.col -->


                <div class="col-md-6">
                  <!-- USERS LIST -->


                </div><!-- /.col -->
              </div><!-- /.row -->


            </div><!-- /.col -->

          </div><!-- /.row -->
        </section><!-- /.content -->
        <?php   }  ?>
      </div><!-- /.content-wrapper -->


<script>
      $(function () {
        /* ChartJS
         * -------
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);


        var areaChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
          datasets: [
            {
//              label: "Electronics",
//              fillColor: "rgba(210, 214, 222, 1)",
//              strokeColor: "rgba(210, 214, 222, 1)",
//              pointColor: "rgba(210, 214, 222, 1)",
//              pointStrokeColor: "#c1c7d1",
//              pointHighlightFill: "#fff",
//              pointHighlightStroke: "rgba(220,220,220,1)",
//              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [<?php echo $MonthIncome_JAN; ?>, <?php echo $MonthIncome_FEB; ?>, <?php echo $MonthIncome_MAR; ?>, <?php echo $MonthIncome_APR; ?>, <?php echo $MonthIncome_MAY; ?>, <?php echo $MonthIncome_JUN; ?>, <?php echo $MonthIncome_JLY; ?>, <?php echo $MonthIncome_AUG; ?>, <?php echo $MonthIncome_SEP; ?>, <?php echo $MonthIncome_OCT; ?>, <?php echo $MonthIncome_NOV; ?>, <?php echo $MonthIncome_DEC; ?>]
            }
          ]
        };


        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
    </script>


<?php
// If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}

include_once 'php-includes/footer.inc.php';


?>
