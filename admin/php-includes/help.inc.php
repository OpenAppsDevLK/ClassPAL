<?php
// Browser Session Start here
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
    $user = $_SESSION['user_name'];

    ?>



    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">          
                <h1>
                    ClassPAL Help

                </h1>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">


                        <div class="col-md-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <i class="fa fa-info-circle"></i>

                                    <h3 class="box-title">Need premium support?</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <p>If you need premium support, you have to buy our support package. contact us for more details. <br>

                                        <a style="margin-top: 10px;" href="https://openapps.dev/support/" target="_blank" class="btn btn-success btn-flat" >Visit our website</a>

                                    </p> 

                                </div>
                                <!-- /.box-body -->
                            </div>
              
                            <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button" data-slug="dilmax" data-color="#FFDD00" data-emoji=""  data-font="Cookie" data-text="Buy me a coffee" data-outline-color="#000000" data-font-color="#000000" data-coffee-color="#ffffff" ></script>

                            <!-- /.box -->
                        </div>

                    </div>
                </div><!-- /.row -->



            </section>

        </div>       

    </div><!-- /.content-wrapper -->

    <?php
    // If session isn't meet, user will redirect to login page
} else {
    header('Location: login.php');
}
