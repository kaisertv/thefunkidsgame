<?php
session_start();
if(isset($_SESSION['admin_email']))
{
    include("dbconnection.php");
}  else {
   header("location:index.php");  
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>The Fun Kids| Admin | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      
          <?php 
          include("momforumnotification.php");
          ?>
          
          
      <!-- Left side column. contains the logo and sidebar -->
      
      <?php
      include_once("includes/leftnavigation.php");
      ?>

      <?php 
      $mom_forum_topic_id=$_REQUEST['id'];
      $mom_topics=  getMomForumTopicsById($mom_forum_topic_id);
      $mom_topic=  mysql_fetch_array($mom_topics);
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $mom_topic['mom_sub_forum_title']; ?>
            <small></small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="momforum.php"><i class="fa fa-dashboard"></i> Mom Forum</a></li>
               <li><a href="mom-forum-topics.php"><i class="fa fa-dashboard"></i> Mom Forum Topics</a></li>
            <li class="active">Update Topic</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
         

          

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              <!-- /.box -->
              <!-- /.row -->

              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                   
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="doupdatemomforumtopic.php" enctype="multipart/form-data">
                    <input type="hidden" name="mom_forum_topic_id" value="<?php echo $mom_topic['mom_sub_forum_id']; ?>">
                     <div class="form-group">
                      <label>Select Forum</label>
                      <select class="form-control" name="mom_forum_id">
                          <option value="">Select Forum</option>
                          <?php 
                          $mom_forum =  getAllMomForum();
                          if($mom_forum>0)
                          {
                              while($momforum=  mysql_fetch_array($mom_forum))
                              {
                          ?>
                          <option value="<?php echo $momforum['mom_forum_id'];  ?>" <?php if($momforum['mom_forum_id']==$mom_topic['mom_forum_id']){ ?> selected="selected" <?php }?>><?php echo $momforum['mom_forum_title'];  ?></option>
                          <?php
                              }
                          }
                          ?>
                        
                        
                      </select>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Topic Title</label>
                      <input type="text" name="mom_sub_forum_title" class="form-control" id="exampleInputEmail1" placeholder="please enter Title" value="<?php echo $mom_topic['mom_sub_forum_title']; ?>">
                    </div>  
                    
                    <div class="form-group">
                      <label for="exampleInputFile">Topic Smiley</label>
                      <input type="file" name="subforum_simlies" id="subforum_simlies">
					  <?php
			if(isset($mom_topic['subforum_simlies'])) 
			echo "<img src = '../subforum_smilies/" . $mom_topic['subforum_simlies'] . "'  />";
		       ?>
		<input type='hidden' name='prev_image' value='<?php if(isset($mom_topic['subforum_simlies'])) echo $mom_topic['subforum_simlies'];?>'/>
                    </div>
			
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Sticky:</label>
                      <input type="radio" name="isStrict" id="isStrict" value="yes" <?php if($mom_topic['isStrict']=='yes'){  ?> checked="checked" <?php }?>>
                    </div>  
                 
                  <!-- /.box-body -->

                  <div class="box-footer">
                      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                      <a href="mom-forum-topics.php" class="btn btn-primary">Back</a>
                  </div>
                </form>
            
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->

            <!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
       <strong>Copyright &copy; 2014-2015 <a href="http://thefunkids.com">The Fun Kids</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>