<?php
    session_start();
    $user;
    $errorpafelocation = 'Location: /dashboard/error.html';
    
    if (isset($_SESSION['user'])) {
        // logged in
        $user = $_SESSION['user'];
    } else {
        // not logged in
        header($errorpafelocation );
     }

     $title = $_POST["title"]; 
     $details = $_POST["details"]; 
     $highlights = $_POST["highlights"]; 
     //$image = $_POST["details"]; 

     if($title != NULL && $details != NULL){
        include ('db.php');
        $sql = "INSERT INTO neon_website.news (title, description, highlights) VALUES ('".$title."', '".$details."' ,'".$highlights."')" ;
        

        $result = mysqli_query($conn, $sql);

        /*
        if($result != FALSE){
            while($row = mysqli_fetch_assoc($result)) {
                 $user = $row["user_name"];
            }
        }*/
     }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="erfan">

    <title>News | NeonSofts</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <?php include ("nav.php") ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Add News 
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i>Add News
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                   if($result != NULL){
                       
                     echo "<div class=\"alert alert-success alert-dismissible\">

                     <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>


                          <strong>Success!</strong> The news has been published
                        </div>";
     
                   }
                ?>
               <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">

                        <form role="form" action="" method="post" >

                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" class="form-control" placeholder="Enter title*" required>
                            </div>

                            <div class="form-group">
                                <label>Details</label>
                                <textarea name="details" class="form-control" rows="9" placeholder="Details*" required></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label>Highlights</label>
                                <input name="highlights" class="form-control" placeholder="Highlights">
                            </div>
                            
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" value="Upload Image (Optional)" name="image">
                               
                            </div>

                            <button type="submit" class="btn btn-success btn-block">Publish</button>

                        </form>
                        <br><br><br>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
   
</body>

</html>
