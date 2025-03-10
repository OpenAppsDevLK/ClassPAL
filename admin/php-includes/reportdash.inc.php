<?php
// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];

        
// Select the user and assign permission...          
$stmt1122 = $db->prepare("SELECT cp_users.id, cp_users.firstname, cp_users.lastname, cp_users.sp_id, cp_userpermission.permission_id, cp_userpermission.uid, cp_userpermission.OnOff  FROM `cp_users` INNER JOIN `cp_userpermission` ON cp_users.id = cp_userpermission.uid WHERE cp_userpermission.uid = {$_SESSION['user_id']} AND cp_userpermission.permission_id = 1122" ); 
$stmt1122->bind_result($cp_users_id, $cp_users_firstname, $cp_users_lastname, $cp_users_sp_id, $cp_userpermission_permission_id, $cp_userpermission_uid, $cp_userpermission_OnOff);
$stmt1122->execute();

while ($stmt1122->fetch()){ 
    
}



function checkSp_id (){
    
    global $cp_users_sp_id;
    
    if($cp_users_sp_id == 1){
        
            $Style = 'display: none;';
            echo $Style;
        
       } 

}

?>



<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
 <?php
    if ($cp_userpermission_OnOff == 0){

        //$Message = "<p class=''>";
        //$Message .= "<img src='Upload/ad.png'>";
        $Message .= "<h1>Access Denied</h1>";
        //$Message .= "</p>";
        echo $Message;
        
    } else {
            
            
?>            
          <h1>
            Reports Dashboard
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

<?php
// Get total students
$stmt = $db->prepare("SELECT COUNT(stu_studentID) FROM cp_students");
$stmt->bind_result($TotalStudents);
$stmt->execute();

while ($stmt->fetch()){


}

?>
        
        <!-- Row 01 -->
        <section class="content">

          <!-- TOTAL STUDENTS -->
          <div class="row">
              <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Students</span>
                  <span class="info-box-number"><?php echo $TotalStudents; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
   
                        <!-- TOTAL Courses -->
            
             <?php
               // Get total allocated students
               $stmt9 = $db->prepare("SELECT COUNT(subj_id) FROM cp_subjects");
               $stmt9->bind_result($all_Subjects);
               $stmt9->execute();

               while ($stmt9->fetch()){
                 
                   
            }

            ?>
            <!-- All Subjects -->
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Courses</span>
                  <span class="info-box-number"><?php echo $all_Subjects; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col --> 
            
                       <?php
               // Get total allocated students
               $stmt1 = $db->prepare("SELECT COUNT(sa_stu_student_id) FROM cp_subj_allo");
               $stmt1->bind_result($TotalAlloStudents);
               $stmt1->execute();

               while ($stmt1->fetch()){
                 
                   
            }

            ?>
            
            <!-- This month New Students -->
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-android-contacts"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Course Allocated Students</span>
                  <span class="info-box-number"><?php echo $TotalAlloStudents; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
             
            
            <?php
                       
              $Date_this_month = date('Y-m');
                        
               // Get total allocated students
               $stmtEnrolments = $db->prepare("SELECT COUNT(stu_studentID) FROM cp_students WHERE stu_regdate LIKE '%{$Date_this_month}%' ");
               $stmtEnrolments->bind_result($NewEnrolments);
               $stmtEnrolments->execute();

               while ($stmtEnrolments->fetch()){
                 
                   
            }

            ?>
            
            <!-- TOTAL Enrolments -->
            <div style="<?php //checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-android-contacts"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Enrolments: <b><?php echo $Date_this_month; ?></b></span>
                  <span class="info-box-number"><?php echo $NewEnrolments; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
            
            
            
            
            
            
            <?php
                // Get total sum of payments...
               $stmt2 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments");
               $stmt2->bind_result($TotalIncome);
               $stmt2->execute();

               while ($stmt2->fetch()){
                $TotalIncome = number_format($TotalIncome, 2, '.', ''); 
                   
            }

            ?>
                        
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Courses Income</span>
                  <span class="info-box-number">Rs. <?php echo $TotalIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            


            <?php
                // Get total sum of payments...
               $stmt_Mise_income = $db->prepare("SELECT SUM(pay_misc_amount) FROM cp_payments");
               $stmt_Mise_income->bind_result($TotalMiseIncome);
               $stmt_Mise_income->execute();

               while ($stmt_Mise_income->fetch()){
                $TotalMiseIncome = number_format($TotalMiseIncome, 2, '.', ''); 
                   
            }

            ?>
                        
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Mise. Income</span>
                  <span class="info-box-number">Rs. <?php echo $TotalMiseIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <?php
            
            $AllTotal_income = $TotalIncome + $TotalMiseIncome;
            
            $AllTotal_income = number_format($AllTotal_income, 2, '.', ''); 
            
            ?>
                        
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Income</span>
                  <span class="info-box-number">Rs. <?php echo $AllTotal_income; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->            
 
            
             <?php
           
               $Date2 = date('Y-m-d');
            
               // To get monthly income...
               $stmt10 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate LIKE '%{$Date2}%'");
               $stmt10->bind_result($TodayIncome);
               $stmt10->execute();

               while ($stmt10->fetch()){
               $TodayIncome = number_format($TodayIncome, 2, '.', '');  
                   
            }

            ?>
            
            <!-- Today Income -->
            <div style="<?php checkSp_id (); ?>"  class="col-md-3 col-sm-3 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Today Course Income</span>
                  <span class="info-box-number">Rs. <?php echo $TodayIncome; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
           <?php
           
               $Date_month_start = date('Y-m-01');
               $Date_month_End = date('Y-m-d');
            
               // To get monthly income...
               $stmt3 = $db->prepare("SELECT SUM(pay_cos_total) FROM cp_payments WHERE pay_paymentdate BETWEEN '$Date_month_start' AND '$Date_month_End'");
               $stmt3->bind_result($MonthIncome);
               $stmt3->execute();

               while ($stmt3->fetch()){
               $MonthIncome = number_format($MonthIncome, 2, '.', '');  
                   
            }

            ?>
            
            <!-- This Month Income -->
            <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This Month Course Income</span>
                  <span class="info-box-number">Rs. <?php echo $MonthIncome; ?></span>
                  <span class="info-box-text">From: <?php echo $Date_month_start; ?> To: <?php echo $Date_month_End; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col --> 
            
            

            
          </div><!-- /.row -->
          

        
          

          <hr>
 
          
         <!-- Report: Total Students-->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Total Students</span>
                  <a href="output/1repoAllStudents.php" target="_blank" class="btn btn-primary btn-flat" >Create</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php
               
               // To get Subject Name
               $stmt4 = $db->prepare("SELECT subj_id, subj_name FROM cp_subjects");
               $stmt4->bind_result($Subj_ID, $Subj_name);
               $stmt4->execute();

            ?>
            
            <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/2repoSubjAlloStudents.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Student Allocated on Courses</span>
                  <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                  <?php
                    while ($stmt4->fetch()){

                    
                  ?>
                     
                      <option value="<?php echo $Subj_ID; ?>"><?php echo $Subj_name; ?></option>
                        
                                       
                  <?php } ?>
                   </select>   
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

                        <?php
   
            //This will show the Subjects
            $stmt13 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt13->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt13->execute();


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Batch Students </span>
                  <form  target="_blank" action="output/3repoSubjBatchNo.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt13->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php
   
            //This will show the Subjects
            $stmt5 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt5->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt5->execute();


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Batch Students Phone Numbers</span>
                  <form  target="_blank" action="output/4repoPhoneNubs.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt5->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            

            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

     
            
 
 
            
            
            <?php
            

            //This will show Students Attendances
            $stmt8 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt8->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt8->execute();

           
            ?>
            
            <div style="<?php checkSp_id (); ?>" class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Students Attendances</span>
                   <form  target="_blank" action="output/5repoStudentAttend.php" method="get" class="form-inline">
                   <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt8->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                       <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder="" required/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder="" required/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
                
            <?php
            

            //This will show Students Attendances
            $stmt8_AnBP = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt8_AnBP->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt8_AnBP->execute();

           
            ?>
                
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div style="<?php checkSp_id (); ?>" class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Students Attendances and Absent of a Period</span>
                   <form  target="_blank" action="output/6repoStudentAttendAndAbsents.php" method="get" class="form-inline">
                   <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt8_AnBP->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                       <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder="" required/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder="" required/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col --> 
            
            <?php
            

            //This will show Students Attendances
            $stmt19 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt19->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt19->execute();

           
            ?>
            
            <div style="<?php checkSp_id (); ?>" class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Mark Absent</span>
                   <form  target="_blank" action="output/7repoAbsentStudent.php" method="get" class="form-inline"> 
                       <input style="margin-bottom: 5px;" class="form-control" type="date" name="Date" value="" placeholder="" required/>
                       <input style="margin-bottom: 5px;" class="form-control" type="text" name="BatchNo" value="" placeholder="Batch No" required/>
                        
                       
                       <select  style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt19->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div style="<?php checkSp_id (); ?>" class="col-md-12 col-sm-12 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Absent Students</span>
                   <form  target="_blank" action="output/8repoABStudent.php" method="get" class="form-inline"> 
                       <input style="margin-bottom: 5px;" class="form-control" type="date" name="Date" value="" placeholder="" required/>
                       <input style="margin-bottom: 5px;" class="form-control" type="text" name="BatchNo" value="" placeholder="Batch No" required/>                    
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                  
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
 
           
           

           <?php
   
            //This will show the Subjects
            $stmt15 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt15->bind_result($AS_Subj_ID, $AS_Sunj_Name);
            $stmt15->execute();


            ?>           
            <div style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
                <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Access Key GENERATOR</span>
                  <form  target="_blank" action="output/9repoAccKeyGen.php" method="get" class="form-inline">
                      <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt15->fetch()){

                           ?>
                          
                       <option value="<?php echo $AS_Subj_ID ?>"><?php echo $AS_Sunj_Name; ?></option>
                        
                        <?php
                         
                        
                              }
                              
                            
                        
                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="text" name="SearchKey" value="" placeholder="Batch No"/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->    
 
 
                     
            
             <div style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/10repoStuInSchool.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Students in School</span>
                  <input style="margin-bottom: 5px;" class="form-control" type="text" name="BatchNo" value="" placeholder="Batch No" required/>                     
                  <input style="margin-bottom: 5px;" class="form-control" type="text" name="SchoolName" value="" placeholder="School Name" required/>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
              <div style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
              <div  style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/11repoStuGender.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Student Gender</span>
                      <select style="margin-bottom: 5px;" name="StudentGender" class="form-control">
                       <option value="Male">Male</option>
                       <option value="Female">Female</option>
                       
                      </select>
               <input style="margin-bottom: 5px;" class="form-control" type="text" name="BatchNo" value="" placeholder="Batch No" required/>                  
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
 
             <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/12repoStudentFull.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: Student Detail Report</span>
                  <input style="margin-bottom: 5px;" class="form-control" type="number" name="StudentID" value="" placeholder="Student ID" required/>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
              
                
            
            
            
 </div><!-- /.row -->
 
 
 
          <hr>
          
          <!-- Info boxes Row 03-->
          <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Total Income</span>
                  <a href="output/13repoTotalincome.php" target="_blank" class="btn btn-primary btn-flat" >Create</a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            <?php

            //This will show Daily Income
            $stmt6 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt6->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt6->execute();

            ?>
            
            <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Daily Income</span>
                  <form  target="_blank" action="output/14repo-DailyIncome.php" method="get" class="form-inline">
                   <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt6->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php

                              }

                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="SearchKey" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <?php
   


            ?>
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Range Income </span>
                  <form  target="_blank" action="output/15repo-RangeIncome.php" method="get" class="form-inline">
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
       
            <?php
            

            //This will show Range Subject Income
            $stmt7 = $db->prepare("SELECT subj_id, subj_name FROM `cp_subjects`");
            $stmt7->bind_result($RepoDailin_Subj_ID, $RepoDailin_Sunj_Name);
            $stmt7->execute();

           
            ?>
            
            <div style="<?php checkSp_id (); ?>"  class="ccol-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00a65a;" class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Report: Range Course Income</span>
                <form  target="_blank" action="output/16repoRangeSubjectIncome.php" method="get" class="form-inline">
                   <select style="margin-bottom: 5px;" name="SubjectID" class="form-control">
                      
                          <?php
                               
                              while ($stmt7->fetch()){

                           ?>
                          
                       <option value="<?php echo $RepoDailin_Subj_ID ?>"><?php echo $RepoDailin_Sunj_Name; ?></option>
                        
                        <?php

                              }

                        ?>
                       
                      </select>
                    
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date01" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="form-control" type="date" name="date02" value="" placeholder=""/>
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                  </form>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            

            
            
            
            
          </div><!-- /.row -->
          
          <hr style="<?php checkSp_id (); ?>" >

          
    
    <div class="row">
              <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/17set_ichart_fixer.php" method="get" class="form-inline">
                  <span class="info-box-text">Setting: Dashboard MONTHLY INCOME CHART Fixer</span>
                  <input style="margin-bottom: 5px;" class="form-control" type="number" name="c_year" value="<?php echo date('Y'); ?>" placeholder="Student ID" required/>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="FIX">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->        
            
               <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-stalker"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/18repologs.php" method="get" class="form-inline">
                  <span class="info-box-text">Report: User Logs</span>
               <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Create">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->   
            
          <div  style="<?php checkSp_id (); ?>" class="col-md-6 col-sm-6 col-xs-12">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-gears"></i></span>
                <div class="info-box-content">
                <form  target="_blank" action="output/19set_clear_logs.php" method="post" class="form-inline">
                  <span class="info-box-text">Setting: Clear User Logs</span>
                  <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" name="clear_logs" type="submit" value="Clear">
                </form>
               </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->   

            <div style="<?php checkSp_id (); ?>"  class="col-md-6 col-sm-6 col-xs-6">
              <div style="background-color: #00c0ef;" class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cloud-download-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Download Database Backup* </span>
                  <form  target="_blank" action="dbbk/dbbk_org.php" method="post" class="form-inline">
                    <input style="margin-bottom: 5px;" class="btn btn-primary btn-flat" type="submit" value="Generate & Download">
                  </form>
                </div><!-- /.info-box-content --
              </div><!-- /.info-box -->
            </div><!-- /.col -->         
          </div><!-- /.row -->
          
          
                      
    </div>       
        </section><!-- /.content -->
        
<?php   
        
    }                                  

?>  
        

      </div><!-- /.content-wrapper -->
   
<?php
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: login.php');
}
